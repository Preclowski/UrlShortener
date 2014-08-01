<?php

namespace Clearcode\UrlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Clearcode\UrlerBundle\Entity\Url;

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
}
