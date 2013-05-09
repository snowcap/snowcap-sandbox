<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Routing\Route;

use Snowcap\AdminDemoBundle\Form\ImageType;
use Snowcap\AdminBundle\Admin\ContentAdmin;

class ImageAdmin extends ContentAdmin
{
    /**
     * @return \Snowcap\AdminBundle\Datalist\DatalistInterface
     */
    public function getDatalist()
    {
        return $this->getDatalistFactory()
            ->createBuilder('datalist', array('data_class' => $this->getEntityClass()))
            ->addField('name')
            ->addAction('update', 'content_admin', array(
                'admin' => $this,
                'action' => 'update'
            ))
            ->addAction('delete', 'content_admin', array(
                'admin' => $this,
                'action' => 'delete',
                'modal' => true
            ))
            ->getDatalist();
    }

    /**
     * @param array $data
     * @return \Symfony\Component\Form\Form
     */
    public function getForm($data = null)
    {
        return $this->getFormFactory()->create(new ImageType(), $data);
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