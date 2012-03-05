<?php

namespace Snowcap\AdminDemoBundle\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilder;

class TaskTranslationType extends AbstractType {
    public function getName(){
        return 'task_translation';
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description', 'markdown')
            ->add('locale', 'hidden');
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Snowcap\AdminDemoBundle\Entity\TaskTranslation');
    }


}