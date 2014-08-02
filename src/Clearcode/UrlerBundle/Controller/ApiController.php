<?php

namespace Clearcode\UrlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Clearcode\UrlerBundle\Entity\Url;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends FOSRestController
{
    /**
     * @View
     */
    public function getUrlAction(Request $request)
    {
        $url = $request->get('url');

        $em = $this->getDoctrine()->getManager();

        try {
            $link = $this->get('clearcode_urler.shortener')->shortenLink($url);
        } catch(\InvalidArgumentException $e) {
            return $e->getMessage();
        }

        $em->persist($link);
        $em->flush();

        return $link;
    }

    /**
     * @View()
     */
    public function getGalleryAction(Request $request)
    {
        $urls = $request->get('urls');
        $slug = $request->get('slug');
        $password = $request->get('password');
        $em = $this->getDoctrine()->getManager();

        $shortenedGallery = $this->get('clearcode_urler.shortener')->shortenGallery($urls, $slug, $password);
        $em->persist($shortenedGallery);

        return $shortenedGallery;
    }
}