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
     * Return the main admin list for this content
     *
     * @return \Snowcap\AdminBundle\Datalist\AbstractDatalist
     */
    public function getDatalist()
    {
        return $this->createDatalist('grid', 'employee')
            ->add('firstName', 'text')
            ->add('lastName', 'text');
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return 'Snowcap\AdminDemoBundle\Entity\Employee';
    }
}