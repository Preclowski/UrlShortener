<?php

namespace Clearcode\UrlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Clearcode\UrlerBundle\Entity\Url;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends FOSRestController
{
    /**
     * @View()
     */
    public function getShortenAction(Request $request)
    {
        $url = $request->get('url');
        $slug = $request->get('slug');
        $password = $request->get('password');

        try {
            $shortened = $this->get('clearcode_urler.shortener')->shortenLink($url, $slug, $password);
        } catch(\InvalidArgumentException $e) {
            return $e->getMessage();
        }

        $em = $this->getDoctrine()->getManager();

        $em->persist($shortened);
        $em->flush();

        return $shortened;
    }
}