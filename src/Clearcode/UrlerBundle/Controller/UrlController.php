<?php

namespace Clearcode\UrlerBundle\Controller;

use Clearcode\UrlerBundle\Exception\InvalidTokenException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Clearcode\UrlerBundle\Entity\Url;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\View;
use PiwikTracker;

require_once '../lib/PiwikTracker/PiwikTracker.php';

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

        $this->trackUrlVisit($link);

        return $this->redirect($link->getUrl());
        /* Url::getType was removed
        $type = $link->getType();

        switch ($type) {
            case Url::TYPE_SIMPLE:
                
            case Url::TYPE_MULTIPLE:
                break;
            case Url::TYPE_PASSWORD:
                break;
            case Url::TYPE_AD:
                break;
            default:
                throw new \InvalidArgumentException('Type not found...');
        }*/
    }

    /**
     * @param $url
     * @throws InvalidTokenException
     * @return Url
     *
     * @QueryParam(
     *      name="url",
     *      requirements=".*",
     *      strict=true,
     *      nullable=false,
     *      description="Url address that will be shortened.")
     * @View()
     */
    public function shortenAction($url)
    {


        return $urlObject;
    }

    private function trackUrlVisit($link)
    {
        $piwikUrl = $this->container->getParameter('piwik.url');
        $ipAddress = $this->container->get('request')->getClientIp();

        $idSite = // TODO

        $tracker = new PiwikTracker($idSite, $piwikUrl);
        $tracker->seturl($link->getUrl());
        $tracker->setUrlReferrer($_SERVER['HTTP_REFERER']);
        $tracker->addExtraHttpHeader("X-Forwarded-For: " . $ipAddress);
        $tracker->addExtraHttpHeader("User-Agent: " . $_SERVER['HTTP_USER_AGENT']);
        $tracker->addExtraHttpHeader("Accept-Language: " . $_SERVER['HTTP_ACCEPT_LANGUAGE']);

        // can track other data if you want, ie, user can set data to be tracked for a specific URL and this can be tracked here.
        // OR! can add a 
        // $tracker->setCustomVariable($id, $name, $value, $scope = 'visit'); // TODO

        // actionName must be set to something, can be name of a single URL or URL group or whatever.
        $tracker->doTrackAction($actionName); // TODO

        /* other stuff you may want to do later.
         - setAttributionInfo (campaign etc.)
         - doTrackGoal
         - doTrackEvent

         - enableCookies (can enable cookies in PiwikTracker if you want to track visitors, otherwise everyone will be a new visitor. visitors are tracked by an ID that is stored in a cookie.)
        */

        /*
        TODO: test w/
          * browser
          * mobile
        */
    }
}