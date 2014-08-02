<?php

namespace Clearcode\UrlerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * UrlGallery
 *
 * @ORM\Table(name="galleries")
 * @ORM\Entity(repositoryClass="Clearcode\UrlerBundle\Entity\UrlGalleryRepository")
 */
class UrlGallery
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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="UrlGalleryItem", mappedBy="gallery")
     */
    private $urls;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->urls = new ArrayCollection;
    }

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
     * Add urls
     *
     * @param \Clearcode\UrlerBundle\Entity\UrlGalleryItem $urls
     * @return UrlGallery
     */
    public function addUrl(\Clearcode\UrlerBundle\Entity\UrlGalleryItem $urls)
    {
        $this->urls[] = $urls;

        return $this;
    }

    /**
     * Remove urls
     *
     * @param \Clearcode\UrlerBundle\Entity\UrlGalleryItem $urls
     */
    public function removeUrl(\Clearcode\UrlerBundle\Entity\UrlGalleryItem $urls)
    {
        $this->urls->removeElement($urls);
    }

    /**
     * Get urls
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return UrlGallery
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }
}
