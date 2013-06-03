<?php

namespace Snowcap\AdminDemoBundle\Admin;

use Snowcap\AdminBundle\Admin\ContentAdmin;

class EmployeeAdmin extends ContentAdmin {
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
            ->add('firstName', 'text')
            ->add('lastName', 'text')
            ->add('company', 'entity', array('class' => 'SnowcapAdminDemoBundle:Company', 'property' => 'name'))
            ->getForm();
    }

    /**
     * @return \Snowcap\AdminBundle\Datalist\DatalistInterface
     */
    public function getDatalist()
    {
        return $this->getDatalistFactory()
            ->createBuilder('datalist', array(
                'data_class' => 'Snowcap\AdminDemoBundle\Entity\Employee'
            ))
            ->addField('firstName')
            ->addField('lastName')
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
        return 'Snowcap\AdminDemoBundle\Entity\Employee';
    }

    /**
     * @param \Snowcap\AdminDemoBundle\Entity\Employee $entity
     * @return string
     */
    public function getEntityName($entity)
    {
        return $entity->getFullName();
    }
}