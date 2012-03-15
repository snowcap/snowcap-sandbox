<?php

namespace Snowcap\AdminDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Snowcap\AdminDemoBundle\Entity\TaskTranslation
 *
 * @ORM\Table(name="task_translation")
 * @ORM\Entity
 */
class TaskTranslation
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $name;


    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="translations")
     */
    private $task;

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
    public function setName($title)
    {
        $this->name = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
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

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param  $task
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * @return
     */
    public function getTask()
    {
        return $this->task;
    }
}