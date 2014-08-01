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
        /* Url::getType removed
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

        $idSite = // TODO

        $tracker = new PiwikTracker($idSite, $piwikUrl);
        $tracker->seturl(); // TODO
        $tracker->setUrlReferrer(); // TODO
        $tracker->setCustomVariable($id, $name, $value, $scope = 'visit'); // TODO

        $tracker->doTrackAction(); // TODO

        // TODO: Forward HTTP_ACCEPT_LANGUAGE
        //       Forward HTTP_USER_AGENT
        //       Set X-Forwarded-For
        /*
         - setAttributionInfo (campaign etc.)

         - setPageCharset // ???

         - doTrackGoal
         - doTrackEvent

         - cookies
        */

        /*
        - set all tracking parameters

        TODO: test w/
          * browser
          * mobile
        */
    }
}