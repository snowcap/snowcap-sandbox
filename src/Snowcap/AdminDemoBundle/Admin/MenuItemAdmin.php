<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminBundle\Datalist\ContentDatalist;

use Snowcap\AdminDemoBundle\Form\MenuItemType;

class MenuItemAdmin extends ContentAdmin
{
    /**
     * Configure the main listing grid
     *
     * @return ContentDatalist
     */
    public function getDatalist()
    {
        $datalist = $this->createDatalist('grid', 'menu');
        $datalist
            ->add('title', 'text')
            ->add('url', 'text')
            ->add('menu.title', 'text', array('label' => 'Menu'))
            ->paginate(10);
        return $datalist;
    }

    public function getForm($data = null)
    {
        $form = $this->createForm(new MenuItemType(), $data);
        return $form;
    }
}