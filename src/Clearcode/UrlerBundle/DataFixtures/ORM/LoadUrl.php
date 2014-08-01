<?php

namespace Acme\HelloBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Clearcode\UrlerBundle\Entity\Url;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $urls = array(
            array('code' => '123456', 'type' => Url::TYPE_SIMPLE, 'url' => 'http://www.wp.pl'),
            array('code' => '234567', 'type' => Url::TYPE_SIMPLE, 'url' => 'http://www.onet.pl'),
            array('code' => '345678', 'type' => Url::TYPE_SIMPLE, 'url' => 'http://www.o2.pl'),
            array('code' => '456789', 'type' => Url::TYPE_SIMPLE, 'url' => 'http://www.google.pl'),
            array('code' => '567890', 'type' => Url::TYPE_SIMPLE, 'url' => 'http://www.ask.com'),
        );

        foreach ($urls as $url) {
            $object = new Url();
            $object->setCode($url['code']);
            $object->setType($url['type']);
            $object->setUrl($url['url']);

            $manager->persist($object);
        }

        $manager->flush();
    }
}
