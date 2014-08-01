<?php

namespace Clearcode\UrlerBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Url", mappedBy="owner", cascade={"all"}, orphanRemoval=true)
     */
    protected $urls;

    public function __construct()
    {
        parent::__construct();
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
     * @param \Clearcode\UrlerBundle\Entity\Url $url
     * @return User
     */
    public function addUrl(\Clearcode\UrlerBundle\Entity\Url $url)
    {
        $this->urls[] = $url;

        return $this;
    }

    /**
     * Remove urls
     *
     * @param \Clearcode\UrlerBundle\Entity\Url $url
     */
    public function removeUrl(\Clearcode\UrlerBundle\Entity\Url $url)
    {
        $this->urls->removeElement($url);
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
}
