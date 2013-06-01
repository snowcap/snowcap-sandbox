<?php

namespace Snowcap\AdminDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Snowcap\CoreBundle\Doctrine\Mapping as SnowcapCore;
use Symfony\Component\HttpFoundation\File\File;

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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $path;

    /**
     * @var File
     *
     * @Assert\File(maxSize="6000000")
     * @SnowcapCore\File(path="uploads/images",mappedBy="path")
     */
    private $file;

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

    /**
     * @param \Symfony\Component\HttpFoundation\File\File $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}