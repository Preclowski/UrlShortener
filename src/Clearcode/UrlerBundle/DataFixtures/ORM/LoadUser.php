<?php

namespace Clearcode\UrlerBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $users = array(
            'user-admin' => array('username' => 'admin', 'password' => 'admin', 'email' => 'admin@admin.com', 'role' => 'ROLE_ADMIN'),
            'user-default' => array('username' => 'user', 'password' => 'user', 'email' => 'user@admin.com', 'role' => 'ROLE_ADMIN'),
        );

        foreach ($users as $reference => $user) {
            $object = $userManager->createUser();

            $object->setUsername($user['username']);
            $object->setEmail($user['email']);
            $object->setPlainPassword($user['password']);
            $object->setEnabled(true);

            $userManager->updateUser($object, false);
            $this->addReference($reference, $object);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
