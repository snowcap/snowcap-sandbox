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
        return $this->formFactory
            ->createBuilder('form', $data)
            ->add('name', 'text')
            ->add('website', 'url')
            ->getForm();
    }

    /**
     * Return the main admin list for this content
     *
     * @return \Snowcap\AdminBundle\Datalist\AbstractDatalist
     */
    public function __getDatalist()
    {
        return $this->createDatalist('grid', 'company')
            ->add('name', 'text')
            ->add('website', 'text');
    }

    public function getDatalist(){
        return $this->datalistFactory
            ->createBuilder('datalist')
            ->setView()
            ->add('name', 'text')
            ->add('website', 'text');
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return 'Snowcap\AdminDemoBundle\Entity\Company';
    }
}