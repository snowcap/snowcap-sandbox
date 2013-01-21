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
            ->add('shortDescription', 'textarea')
            ->add('website', 'url')
            ->getForm();
    }

    public function getDatalist(){
        return $this->datalistFactory
            ->createBuilder('datalist', array(
                'data_class' => 'Snowcap\AdminDemoBundle\Entity\Company',
                'limit_per_page' => 10,
                'search' => 'e.name'
            ))
            ->addField('name')
            ->addField('shortDescription')
            ->addField('website')
            ->getDatalist();
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return 'Snowcap\AdminDemoBundle\Entity\Company';
    }
}