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
    public function getList()
    {
        $datalist = $this->createDatalist('post', 'grid');
        $datalist
            ->add('id', 'text');
        return $datalist;
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
                'property' => 'title',
                'inline_admin' => $this->environment->getAdmin('image'),
                'preview' => array(
                    'type' => 'image',
                )
            ))
            ->add('visuals', 'snowcap_admin_inline', array(
                'class' => 'Snowcap\AdminDemoBundle\Entity\Image',
                'multiple' => true,
                'property' => 'title',
                'inline_admin' => $this->environment->getAdmin('image'),
                'preview' => array(
                    'type' => 'image',
                )
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