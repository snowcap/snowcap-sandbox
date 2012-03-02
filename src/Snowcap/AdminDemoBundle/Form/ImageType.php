<?php

namespace Snowcap\AdminDemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ImageType extends AbstractType
{
    public function getName()
    {
        return 'image_translation';
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('file', 'snowcap_core_image', array('web_path' => 'webPath'))
            ->add('translations', 'collection', array(
            'type' => new ImageTranslationType(),
        ));
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Snowcap\AdminDemoBundle\Entity\Image');
    }


}