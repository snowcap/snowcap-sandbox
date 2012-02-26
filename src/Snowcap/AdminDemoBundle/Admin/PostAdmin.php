<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminBundle\Grid\ContentGrid;

class PostAdmin extends ContentAdmin
{
    /**
     * Configure the main listing grid
     *
     * @param \Snowcap\AdminBundle\Grid\ContentGrid $grid
     */
    protected function configureContentGrid(ContentGrid $grid)
    {
        // TODO: Implement configureContentGrid() method.
    }

    protected function buildForm(FormBuilder $builder)
    {
        $builder
            ->add($builder->create('general', 'fieldset', array('legend' => 'general information'))
                ->add('title')
                ->add('slug')
            )
            ->add($builder->create('other', 'fieldset', array('legend' => 'other info'))
                ->add('body')
                ->add('published_on')
        );
        return $builder;
    }
}