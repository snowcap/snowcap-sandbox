<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminBundle\Grid\ContentGrid;
use Snowcap\AdminDemoBundle\Form\ImageType;

class TaskAdmin extends ContentAdmin
{
    /**
     * Configure the main listing grid
     *
     * @param \Snowcap\AdminBundle\Grid\ContentGrid $grid
     */
    protected function configureContentGrid(ContentGrid $grid)
    {
        $grid->addColumn('name');
    }

    protected function buildForm(FormBuilder $builder)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('image', 'snowcap_admin_inline', array(
                    'class' => 'Snowcap\AdminDemoBundle\Entity\Image',
                    'property' => 'title',
                    'inline_admin' => $this->environment->getAdmin('inline_image'),
                    'preview' => array(
                        'type' => 'image',
                    )
                )
            )
            ->add('visuals', 'collection', array(
                'type' => new ImageType(),
                'allow_add' => true,
                'prototype' => true,
                'initial_data' => $this->environment->getAdmin('image')->getBlankEntity(),
                //'by_reference' => false

        ));
        return $builder;
    }


}