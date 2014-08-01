<?php

namespace Clearcode\UrlerBundle\Controller;

use Clearcode\UrlerBundle\Exception\InvalidTokenException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clearcode\UrlerBundle\Entity\Url;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\View;

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

        $type = $link->getType();

        switch ($type) {
            case Url::TYPE_SIMPLE:
                return $this->redirect($link->getUrl());
                break;
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
}
