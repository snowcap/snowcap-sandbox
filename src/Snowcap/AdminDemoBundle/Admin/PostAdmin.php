<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminBundle\Datalist\ContentDatalist;

use Snowcap\AdminDemoBundle\Form\PostType;

class PostAdmin extends ContentAdmin
{
    /**
     * Configure the main listing grid
     *
     * @param \Snowcap\AdminBundle\Grid\ContentGrid $grid
     */
    public function getDatalist()
    {
        $datalist = $this->createDatalist('grid', 'post');
        $datalist
            ->add('title', 'text')
            ->paginate(10);
        return $datalist;
    }

    public function getSearchForm()
    {
        $builder = $this->environment->get('form.factory')->createBuilder('search')
            ->add('e.title', 'text');
        return $builder->getForm();
    }

    public function getForm($data = null)
    {

        $form = $this->createForm(new PostType(), $data);
        return $form;
    }
}