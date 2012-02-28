<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminBundle\Grid\ContentGrid;

class ImageAdmin extends ContentAdmin
{
    /**
     * Configure the main listing grid
     *
     * @param \Snowcap\AdminBundle\Grid\ContentGrid $grid
     */
    protected function configureContentGrid(ContentGrid $grid)
    {
        $grid->addColumn('title');
    }

    protected function buildForm(FormBuilder $builder)
    {
        $builder
            ->add('title')
            ->add('path');
        return $builder;
    }


}