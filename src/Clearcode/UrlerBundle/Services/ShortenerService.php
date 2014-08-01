<?php

namespace Clearcode\UrlerBundle\Services;

use Clearcode\UrlerBundle\Entity\Url;
use Clearcode\UrlerBundle\Generator\TokenGeneratorInterface;

class ShortenerService
{
    /**
     * @var TokenGeneratorInterface $tokenGenerator
     */
    private $tokenGenerator;

    /**
     * @param TokenGeneratorInterface $tokenGenerator
     */
    public function __construct(TokenGeneratorInterface $tokenGenerator)
    {
        $this->tokenGenerator = $tokenGenerator;
    }

    /**
     * Generate shortened link with slug as code
     *
     * @param string $url
     * @param string $slug
     * @param string $password
     *
     * @return Url
     */
    public function shortenLink($url, $slug = null, $password = null)
    {
        return new Url($url, $this->tokenGenerator->generate($slug), $password);
    }
}
