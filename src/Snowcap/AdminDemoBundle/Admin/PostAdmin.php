<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminBundle\Grid\ContentGrid;
use Snowcap\AdminBundle\Datalist\ContentDatalist;

class PostAdmin extends ContentAdmin
{
    /**
     * Configure the main listing grid
     *
     * @param \Snowcap\AdminBundle\Grid\ContentGrid $grid
     */
    public function getList()
    {
        $datalist = $this->createDatalist('post', 'grid');
        $datalist
            ->add('title', 'text');
        return $datalist;
    }

    protected function buildForm(FormBuilder $builder)
    {
        $builder
            ->add('title')
            ->add('slug', 'slug', array('target' => 'title'))
            ->add('body', 'markdown')
            ->add('published_on', 'datetime', array(
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
                'date_format' => 'dd/MM/yyyy',
                'input' => 'datetime',
                'attr' => array(
                    'placeholder' => 'dd/mm/yyyy hh:mm'
                )
        ));
        return $builder;
    }
}