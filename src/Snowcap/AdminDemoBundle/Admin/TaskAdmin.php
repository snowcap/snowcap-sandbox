<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminDemoBundle\Form\TaskType;
use Snowcap\AdminDemoBundle\Form\TaskTranslationType;
use Snowcap\AdminDemoBundle\Form\ImageType;
use Snowcap\AdminDemoBundle\Entity\TaskTranslation;

class TaskAdmin extends ContentAdmin
{
    /**
     * Configure the main listing grid
     *
     * @param \Snowcap\AdminBundle\Grid\ContentGrid $grid
     */
    public function getDatalist()
    {
        $datalist = $this->createDatalist('grid', 'task');
        $datalist
            ->add('id', 'text');
        return $datalist;
    }

    public function getForm($data = null)
    {
        $form = $this->createForm(new TaskType(), $data);
        return $form;
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

    public function buildEntity()
    {
        $entity = parent::buildEntity();
        $entity->setTranslations(array(
            new TaskTranslation('fr'),
            new TaskTranslation('en'),
            new TaskTranslation('nl'),
            new TaskTranslation('de'),
        ));
        return $entity;
    }
}