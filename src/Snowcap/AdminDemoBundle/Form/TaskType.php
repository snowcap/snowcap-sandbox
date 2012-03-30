<?php

namespace Snowcap\AdminDemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

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
            ->add('translations', 'collection', array(
                'type' => new TaskTranslationType(),
                'tabbable' => true,
                'property' => 'locale',
                'html_id' => 'task',
            ))
            ->add('image', 'snowcap_admin_inline', array(
                'class' => 'Snowcap\AdminDemoBundle\Entity\Image',
                'inline_admin' => 'image',
                'preview' => array(
                    'type' => 'image',
                )
            ))
            ->add('visuals', 'snowcap_admin_inline', array(
                'class' => 'Snowcap\AdminDemoBundle\Entity\Image',
                'multiple' => true,
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