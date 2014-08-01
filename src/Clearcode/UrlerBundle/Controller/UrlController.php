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

        $type = $link->getType();

        switch ($type) {
            case Url::TYPE_SIMPLE:
                return $this->redirect($link->getUrl());
            case Url::TYPE_MULTIPLE:
                break;
            case Url::TYPE_PASSWORD:
                break;
            case Url::TYPE_AD:
                break;
            default:
                throw new \InvalidArgumentException('Type not found...');
        }
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
        $tracker = new PiwikTracker($idSite = 1); // TODO
        // TODO
    }
}
