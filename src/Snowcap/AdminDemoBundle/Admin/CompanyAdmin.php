<?php

namespace Snowcap\AdminDemoBundle\Admin;

use Snowcap\AdminBundle\Admin\ContentAdmin;

class CompanyAdmin extends ContentAdmin {
    /**
     * Return the main admin form for this content
     *
     * @param object $data
     * @return \Symfony\Component\Form\Form
     */
    public function getForm($data = null)
    {
        return $this->getFormFactory()
            ->createBuilder('form', $data, array('data_class' => $this->getEntityClass()))
            ->add('name', 'text')
            ->add('shortDescription', 'textarea')
            ->add('website', 'url')
            ->getForm();
    }

    public function getDatalist(){
        return $this->getDatalistFactory()
            ->createBuilder('datalist', array(
                'data_class' => 'Snowcap\AdminDemoBundle\Entity\Company',
                'limit_per_page' => 10,
                'search' => 'e.name'
            ))
            ->addField('name')
            ->addField('shortDescription')
            ->addField('website')
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
     * @return string
     */
    public function getEntityClass()
    {
        return 'Snowcap\AdminDemoBundle\Entity\Company';
    }

    /**
     * @param \Snowcap\AdminDemoBundle\Entity\Company $entity
     * @return string
     */
    public function getEntityName($entity)
    {
        return $entity->getName();
    }
}