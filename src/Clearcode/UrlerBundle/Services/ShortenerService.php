<?php

namespace Clearcode\UrlerBundle\Services;

use Clearcode\UrlerBundle\Entity\Url;
use Clearcode\UrlerBundle\Generator\TokenGeneratorInterface;
use Doctrine\ORM\EntityManager;

class ShortenerService
{
    /**
     * @var EntityManager $em
     */
    private $em;

    /**
     * @var TokenGeneratorInterface $tokenGenerator
     */
    private $tokenGenerator;

    /**
     * @param TokenGeneratorInterface $tokenGenerator
     * @param EntityManager $em
     */
    public function _construct(TokenGeneratorInterface $tokenGenerator, EntityManager $em)
    {
        $this->tokenGenerator = $tokenGenerator;
        $this->em = $em;
    }

    /**
     * Generate random shortened url with random code
     *
     * @param $url
     *
     * @return Url
     */
    public function shortenToRandom($url)
    {
        $token = $this->generator->generate();

        $shortened = new Url($url, $token);

        $this->em->persist($shortened);

        return $shortened;
    }

    /**
     * Generate shortened link with slug as code
     * @param $url
     * @param $slug
     *
     * @return Url
     */
    public function shortenToSlug($url, $slug)
    {
        if ($this->em->getRepository('ClearcodeUrlerBundle:Url')->findOneByCode($slug)) {
            throw new \InvalidArgumentException('This slug is already used.');
        }

        $shortened = new Url($url, $slug);

        $this->em->persist($shortened);

        return $shortened;
    }
}
