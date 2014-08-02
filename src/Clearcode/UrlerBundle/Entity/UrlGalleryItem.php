<?php

namespace Clearcode\UrlerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UrlGalleryItem
 *
 * @ORM\Table(name="gallery_items")
 * @ORM\Entity(repositoryClass="Clearcode\UrlerBundle\Entity\UrlGalleryItemRepository")
 */
class UrlGalleryItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var UrlGallery
     *
     * @ORM\ManyToOne(targetEntity="UrlGallery", inversedBy="urls")
     */
    private $urlGallery;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return UrlGalleryItem
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set urlGallery
     *
     * @param \Clearcode\UrlerBundle\Entity\UrlGallery $urlGallery
     * @return UrlGalleryItem
     */
    public function setUrlGallery(\Clearcode\UrlerBundle\Entity\UrlGallery $urlGallery = null)
    {
        $this->urlGallery = $urlGallery;

        return $this;
    }

    /**
     * Get urlGallery
     *
     * @return \Clearcode\UrlerBundle\Entity\UrlGallery 
     */
    public function getUrlGallery()
    {
        return $this->urlGallery;
    }
}
