<?php

namespace Snowcap\AdminDemoBundle\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilder;

class ImageTranslationType extends AbstractType {
    public function getName(){
        return 'image_translation';
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('title');
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Snowcap\AdminDemoBundle\Entity\ImageTranslation');
    }


}