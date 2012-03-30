<?php

namespace Snowcap\AdminDemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;

use Snowcap\AdminDemoBundle\Form\TaskTranslationType;

class TaskType extends AbstractType
{

    public function getName()
    {
        return 'task';
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('image', 'snowcap_admin_inline', array(
                'class' => 'Snowcap\AdminDemoBundle\Entity\Image',
                'property' => 'title',
                'inline_admin' => 'image',
                'preview' => array(
                    'type' => 'image',
                )
            ));
        return $builder;
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Snowcap\AdminDemoBundle\Entity\Task');
    }
}