<?php

namespace Snowcap\AdminDemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MenuItemType extends AbstractType
{
    public function getName()
    {
        return 'menu_item';
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('menu', 'entity', array('class' => 'Snowcap\AdminDemoBundle\Entity\Menu', 'property' => 'title'))
            ->add('url')
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Snowcap\AdminDemoBundle\Entity\MenuItem');
    }


}