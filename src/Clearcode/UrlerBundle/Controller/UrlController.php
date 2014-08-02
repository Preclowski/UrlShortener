<?php

namespace Clearcode\UrlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clearcode\UrlerBundle\Entity\Url;
use Symfony\Component\HttpFoundation\Response;
use PiwikTracker;

class UrlController extends Controller
{
    public function resolveAction($code)
    {
        $link = $this->getDoctrine()
            ->getRepository('ClearcodeUrlerBundle:Url')
            ->findOneByCode($code);

        if (!$link) {
            throw $this->createNotFoundException('Link not found');
        }

        $idSite = 7;
        $piwikUrl = $this->container->getParameter('piwik.url');
        $ipAddress = $this->container->get('request')->getClientIp();

        $tracker = new \PiwikTracker($idSite, $piwikUrl);

        $tracker->setUrl($link->getUrl());
        $tracker->setUrlReferrer($this->getRequest()->headers->get('HTTP_REFERER'));
        $tracker->addExtraHttpHeader("X-Forwarded-For: " . $ipAddress);
        $tracker->addExtraHttpHeader("User-Agent: " . $this->getRequest()->headers->get('HTTP_USER_AGENT'));
        $tracker->addExtraHttpHeader("Accept-Language: " . $this->getRequest()->headers->get('HTTP_ACCEPT_LANGUAGE'));

        $tracker->doTrackAction($link->getUrl(), 'link');

        return $this->redirect($link->getUrl());
    }
}
