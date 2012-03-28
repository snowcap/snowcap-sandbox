<?php

namespace Snowcap\AdminDemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use \Snowcap\AdminDemoBundle\Entity\ImageTranslation;

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
            ->add('file', 'snowcap_core_image', array('web_path' => 'path'))
            ->add('translations', 'collection', array(
                'type' => new ImageTranslationType(),
                'by_reference' => false,
                'allow_add' => true,
                'tabbable' => true,
                'property' => 'locale',
                'html_id' => 'image'
        ));
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Snowcap\AdminDemoBundle\Entity\Image');
    }


}