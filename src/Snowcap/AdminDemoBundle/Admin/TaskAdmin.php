<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminBundle\Grid\ContentGrid;

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
            ->add('image', 'inline', array(
                    'class' => 'Snowcap\AdminDemoBundle\Entity\Image',
                    'property' => 'title',
                    'route' => 'snowcap_admin_inline_create',
                    'params' => array('property' => 'title', 'code' => 'image')
                )
            );
        return $builder;
    }


}