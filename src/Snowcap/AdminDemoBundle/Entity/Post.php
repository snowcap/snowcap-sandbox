<?php

namespace Snowcap\AdminDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Snowcap\AdminDemoBundle\Entity\Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity
 */
class Post
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string $body
     *
     * @ORM\Column(name="body", type="string", length=255)
     */
    private $body;

    /**
     * @var string $published_on
     *
     * @ORM\Column(name="published_on", type="datetime", length=255)
     */
    private $published_on;


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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set body
     *
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set published_on
     *
     * @param string $publishedOn
     */
    public function setPublishedOn($publishedOn)
    {
        $this->published_on = $publishedOn;
    }

    /**
     * Get published_on
     *
     * @return string 
     */
    public function getPublishedOn()
    {
        return $this->published_on;
    }
}