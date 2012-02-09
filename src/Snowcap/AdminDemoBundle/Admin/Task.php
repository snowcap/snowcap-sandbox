<?php
namespace Snowcap\AdminDemoBundle\Admin;

use
    Snowcap\AdminBundle\Admin\Content,
    Snowcap\AdminBundle\Grid\Content as Grid,
    Snowcap\AdminBundle\Form\ContentType as FormType;

class Task extends Content {

    public function buildGrid(Grid $grid) {
        $grid
            ->setOption('order_field', 'position')
            ->addColumn('name');
    }

    public function buildForm(FormType $type) {
        $type->addField('name', 'text');
    }
}