<?php

namespace Clearcode\UrlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clearcode\UrlerBundle\Entity\Url;
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

        $piwikUrl = $this->container->getParameter('piwik.url');
        $ipAddress = $this->container->get('request')->getClientIp();

        $tracker = new PiwikTracker($idSite, $piwikUrl);

        $tracker->seturl($link->getUrl());
        $tracker->setUrlReferrer($_SERVER['HTTP_REFERER']);
        $tracker->addExtraHttpHeader("X-Forwarded-For: " . $ipAddress);
        $tracker->addExtraHttpHeader("User-Agent: " . $_SERVER['HTTP_USER_AGENT']);
        $tracker->addExtraHttpHeader("Accept-Language: " . $_SERVER['HTTP_ACCEPT_LANGUAGE']);

        $tracker->doTrackAction($actionName);

        return $this->redirect($link->getUrl());
    }
}
