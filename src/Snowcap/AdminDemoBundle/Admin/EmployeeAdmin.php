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
        return $this->formFactory
            ->createBuilder('form', $data)
            ->add('firstName', 'text')
            ->add('lastName', 'text')
            ->getForm();
    }

    /**
     * @return \Snowcap\AdminBundle\Datalist\DatalistInterface
     */
    public function getDatalist()
    {
        return $this->datalistFactory
            ->createBuilder('datalist', array(
                'data_class' => 'Snowcap\AdminDemoBundle\Entity\Employee'
            ))
            ->addField('firstName')
            ->addField('lastName')
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