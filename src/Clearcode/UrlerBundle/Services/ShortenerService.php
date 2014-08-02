<?php

namespace Clearcode\UrlerBundle\Services;

use Clearcode\UrlerBundle\Entity\Url;
use Clearcode\UrlerBundle\Entity\UrlGallery;
use Clearcode\UrlerBundle\Entity\UrlGalleryItem;
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
     * @return Url
     */
    public function shortenLink($url)
    {
        $link = new Url;
        $link->setUrl($url);
        $link->setCode($this->tokenGenerator->generate());

        return $link;
    }

    /**
     * Generate gallery of links
     *
     * @param array $urls
     * @param null $slug
     * @param null $password
     * @return UrlGallery
     */
    public function shortenGallery(array $urls, $slug = null, $password = null)
    {
        $gallery = new UrlGallery($slug, $password);

        foreach ($urls as $url) {
            $gallery->addUrl(new UrlGalleryItem($url));
        }

        return $gallery;
    }
}
