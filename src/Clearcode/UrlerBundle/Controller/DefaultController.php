<?php

namespace Clearcode\UrlerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ClearcodeUrlerBundle:Default:index.html.twig', array('name' => $name));
    }
}
