<?php

namespace Snowcap\AdminDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Snowcap\AdminDemoBundle\Entity\Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity
 */
class Task
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
     * @var Image
     *
     * @ORM\ManyToOne(targetEntity="Image", cascade={"persist"})
     * @ORM\JoinColumn(name="image_id")
     */
    private $image;

    /**
     * @var
     *
     * @ORM\ManyToMany(targetEntity="Image", cascade={"persist"})
     */
    private $visuals;

    /**
     * @ORM\OneToMany(targetEntity="TaskTranslation", mappedBy="image", indexBy="locale", cascade = {"all"})
     */
    private $translations;

    public function __construct()
    {
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
     * @param \Snowcap\AdminDemoBundle\Entity\Image $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return \Snowcap\AdminDemoBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param  $visuals
     */
    public function setVisuals($visuals)
    {
        $this->visuals = $visuals;
    }

    /**
     * @return
     */
    public function getVisuals()
    {
        return $this->visuals;
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