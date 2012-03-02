<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminBundle\Grid\ContentGrid;
use Snowcap\AdminDemoBundle\Entity\ImageTranslation;
use Snowcap\AdminDemoBundle\Form\ImageTranslationType;
use Snowcap\AdminDemoBundle\Form\ImageType;

class ImageAdmin extends ContentAdmin
{
    /**
     * Configure the main listing grid
     *
     * @param \Snowcap\AdminBundle\Grid\ContentGrid $grid
     */
    protected function configureContentGrid(ContentGrid $grid)
    {
        $grid->addColumn('title');
    }

    protected function buildForm(FormBuilder $builder)
    {
        $builder
            ->add('title')
            ->add('file', 'snowcap_core_image', array('web_path' => 'webPath'))
            ->add('translations', 'collection', array(
                'type' => new ImageTranslationType(),
            ));
        return $builder;
    }

    public function getForm($data){
        $builder = $this->environment->get('form.factory')->createBuilder(new ImageType(), $data, array('data_class' => $this->getParam('entity_class')));
        //$this->buildForm($builder);
        return $builder->getForm();
    }

    public function buildPreview($preview)
    {
        $preview
            ->add('street', 'image')
            ->add('zip', 'text');
    }

    public function getBlankEntity()
    {
        $entity = parent::getBlankEntity();
        $entity->setTranslations(array(
            new ImageTranslation('fr'),
            new ImageTranslation('en'),
            new ImageTranslation('nl'),
            new ImageTranslation('de'),
        ));
        return $entity;
    }


}