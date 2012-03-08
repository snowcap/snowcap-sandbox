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
            ->add('slug')
            ->add('body', 'markdown')
            ->add('published_on');
        return $builder;
    }
}