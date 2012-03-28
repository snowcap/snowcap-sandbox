<?php

namespace Snowcap\AdminDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Snowcap\CoreBundle\Doctrine\Mapping as Snowcap;

/**
 * Snowcap\AdminDemoBundle\Entity\Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image
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
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @ORM\OneToMany(targetEntity="ImageTranslation", mappedBy="image", indexBy="locale", cascade={"all"})
     */
    private $translations;

    /**
     *
     * @Assert\File(maxSize="6000000")
     * @Snowcap\File(path="uploads/images",mappedBy="path")
     */
    public $file;

    public function __construct(){
        $this->translations = new ArrayCollection();
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
     * Set path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    public function setTranslations($translations)
    {
        foreach($translations as $translation) {
            $translation->setImage($this);
            $this->translations->add($translation);
        }
    }

    public function getTranslations()
    {
        return $this->translations;
    }
}