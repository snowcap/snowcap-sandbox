<?php

namespace Snowcap\AdminDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

use Snowcap\CoreBundle\Entity\TranslatableEntityInterface;

/**
 * Snowcap\AdminDemoBundle\Entity\Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity
 */
class Task implements TranslatableEntityInterface
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
     * @ORM\OneToMany(targetEntity="TaskTranslation", mappedBy="task", indexBy="locale", cascade = {"all"})
     */
    private $translations;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=32)
     */
    private $code;

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

    public function setTranslations($translations)
    {
        foreach($translations as $translation) {
            $translation->setTask($this);
            $this->translations->add($translation);
        }
    }

    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

}