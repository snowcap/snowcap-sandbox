<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Routing\Route;

use Snowcap\AdminDemoBundle\Form\ImageType;
use Snowcap\AdminBundle\Admin\ContentAdmin;

class ImageAdmin extends ContentAdmin
{
    /**
     * @return \Snowcap\AdminBundle\Datalist\AbstractDatalist
     */
    public function getDatalist()
    {
        return $this->datalistFactory
            ->createBuilder('datalist', array('data_class' => 'Snowcap\AdminDemoBundle\Entity\Image'))
            ->addField('name')
            ->getDatalist();
    }

    /**
     * @param array $data
     * @return \Symfony\Component\Form\Form
     */
    public function getForm($data = null)
    {
        return $this->formFactory->create(new ImageType(), $data);
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return 'Snowcap\AdminDemoBundle\Entity\Image';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'image';
    }

    /**
     * @param \Snowcap\AdminDemoBundle\Entity\Image $entity
     * @return mixed
     */
    public function getEntityName($entity)
    {
        return $entity->getName();
    }
}