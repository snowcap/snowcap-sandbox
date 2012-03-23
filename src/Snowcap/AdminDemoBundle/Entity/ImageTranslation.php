<?php

namespace Snowcap\AdminDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Snowcap\AdminDemoBundle\Entity\ImageTranslation
 *
 * @ORM\Table(name="image_translation")
 * @ORM\Entity
 */
class ImageTranslation
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
     * @var string $locale
     *
     * @ORM\Column(name="locale", type="string", length=255)
     */
    private $locale;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="translations")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id",nullable=false)
     */
    private $image;

    public function __construct($locale = null){
        $this->locale = $locale;
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
     * Set locale
     *
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
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
     * @param  $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return
     */
    public function getImage()
    {
        return $this->image;
    }
}