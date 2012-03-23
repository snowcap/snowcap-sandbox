<?php

namespace Snowcap\AdminDemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PostType extends AbstractType
{
    public function getName()
    {
        return 'post';
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('slug', 'slug', array('target' => 'title'))
            ->add('body', 'markdown')
            ->add('published_on', 'date', array(
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'attr' => array(
                    'placeholder' => 'dd/mm/yyyy'
                )
            )
        );
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Snowcap\AdminDemoBundle\Entity\Post');
    }


}