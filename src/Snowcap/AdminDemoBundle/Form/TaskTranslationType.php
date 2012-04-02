<?php

namespace Snowcap\AdminDemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;

class TaskTranslationType extends AbstractType
{

    public function getName()
    {
        return 'task_translation';
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug', 'slug', array(
                'target' => 'name',
            ))
            ->add('description', 'wysiwyg', array(
                'style_file' => 'bundles/snowcapadmindemo/js/ckeditor_styles.js',
                'css_file' => 'bundles/snowcapadmindemo/css/ckeditor.css'
            ));
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Snowcap\AdminDemoBundle\Entity\TaskTranslation');
    }


}