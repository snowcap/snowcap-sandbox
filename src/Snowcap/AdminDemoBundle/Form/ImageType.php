<?php

namespace Snowcap\AdminDemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use \Snowcap\AdminDemoBundle\Entity\ImageTranslation;

class ImageType extends AbstractType
{
    public function getName()
    {
        return 'image';
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('file', 'snowcap_core_image', array('web_path' => 'path'));
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Snowcap\AdminDemoBundle\Entity\Image');
    }


}