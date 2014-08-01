<?php

namespace Clearcode\UrlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UrlController extends Controller
{
    public function resolveAction($code)
    {
        $link = $this->getDoctrine()
            ->getRepository('ClearcodeUrlerBundle:Url')
            ->findOneByCode($code);

        $type = $link->getType();

        switch ($type) {
            case Url::TYPE_SIMPLE:
                $this->redirect($link->getUrl());
                break;
            case Url::TYPE_MULTIPLE:
                break;
            case Url::TYPE_PASSWORD:
                break;
            case Url::TYPE_AD:
                break;
            default:
                throw new \InvalidArgumentException('Link not found...');
        }
    }
}
