<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminBundle\Datalist\ContentDatalist;

use Snowcap\AdminDemoBundle\Form\MenuType;

class MenuAdmin extends ContentAdmin
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
            ->add('code', 'text')
            ->paginate(10);
        return $datalist;
    }

    public function getForm($data = null)
    {
        $form = $this->createForm(new MenuType(), $data);
        return $form;
    }
}