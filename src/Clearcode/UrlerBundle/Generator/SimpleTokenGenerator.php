<?php

namespace Clearcode\UrlerBundle\Generator;

use Doctrine\ORM\EntityManager;

/**
 * Token generator based on uniqid php function.
 *
 * @package Clearcode\UrlerBundle\Services
 */
class SimpleTokenGenerator implements TokenGeneratorInterface
{
    /**
     * @var EntityManager $em
     */
    private $em;

    /**
     * Constructor
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $slug
     *
     * @return mixed
     */
    public function generate()
    {
        return $this->generateRandom();
    }

    /**
     * @var string $slug
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    public function checkForSlug($slug)
    {
        if (strlen($slug) < 3) {
            throw new \InvalidArgumentException('Minimum length of slug is 3 characters.');
        }

        if (!ctype_alnum($slug)) {
            throw new \InvalidArgumentException('Only alphanumeric characters are allowed.');
        }

        if (!is_null($this->em->getRepository('ClearcodeUrlerBundle:Url')->findOneByCode($slug))) {
            throw new \InvalidArgumentException('That slug already exists.');
        }

        return $slug;
    }

    /**
     * {@inheritDoc}
     */
    public function generateRandom()
    {
        return substr(strrev(uniqid()), 0, 6);
    }
}
 