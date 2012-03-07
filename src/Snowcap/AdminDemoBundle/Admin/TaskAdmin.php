<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminBundle\Grid\ContentGrid;
use Snowcap\AdminDemoBundle\Form\ImageType;
use Snowcap\AdminDemoBundle\Form\TaskTranslationType;
use Snowcap\AdminDemoBundle\Entity\TaskTranslation;

class TaskAdmin extends ContentAdmin
{
    /**
     * Configure the main listing grid
     *
     * @param \Snowcap\AdminBundle\Grid\ContentGrid $grid
     */
    protected function configureContentGrid(ContentGrid $grid)
    {
        $grid->addColumn('id');
    }

    protected function buildForm(FormBuilder $builder)
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
                    'inline_admin' => $this->environment->getAdmin('image'),
                )
            )
            ->add('visuals', 'collection', array(
                'type' => new ImageType(),
                'allow_add' => true,
                'prototype' => true,
                'initial_data' => $this->environment->getAdmin('image')->getBlankEntity(),
                //'by_reference' => false

        ));
        return $builder;
    }

    public function getFieldsets()
    {
        return array(
            array(
                'legend' => 'Translations',
                'rows' => array('translations'),
            ),
            array(
                'legend' => 'Thumbnail',
                'rows' => array('image'),
            ),
            array(
                'legend' => 'Media',
                'rows' => array('visuals'),
            ),
        );
    }

    public function getBlankEntity()
    {
        $entity = parent::getBlankEntity();
        $entity->setTranslations(array(
            new TaskTranslation('fr'),
            new TaskTranslation('en'),
            new TaskTranslation('nl'),
            new TaskTranslation('de'),
        ));
        return $entity;
    }
}