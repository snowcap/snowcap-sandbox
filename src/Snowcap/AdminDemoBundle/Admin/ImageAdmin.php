<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;

use Snowcap\AdminBundle\Admin\ContentAdmin;
use Snowcap\AdminBundle\Grid\ContentGrid;
use Snowcap\AdminBundle\Datalist\ContentDatalist;
use Snowcap\AdminDemoBundle\Entity\ImageTranslation;
use Snowcap\AdminDemoBundle\Form\ImageTranslationType;
use Snowcap\AdminDemoBundle\Form\ImageType;

class ImageAdmin extends ContentAdmin
{

    public function getList()
    {
        $datalist = $this->createDatalist('image', 'thumbnail');
        $datalist
            ->add('webPath', 'image')
            ->add('title', 'label');
        return $datalist;
    }

    public function getSearchForm()
    {
        $builder = $this->environment->get('form.factory')->createBuilder('search')
            ->add('e.title', 'text');
        return $builder->getForm();
    }

    public function getForm($data)
    {
        $builder = $this->environment->get('form.factory')->createBuilder(new ImageType(), $data, array('data_class' => $this->getParam('entity_class')));
        return $builder->getForm();
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

    public function getPreviewBlockName()
    {
        return 'image_preview';
    }

    public function filterAutocomplete($input) {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->add('where', $queryBuilder->expr()->like('e.title', $queryBuilder->expr()->literal('%' . $input . '%')));
        return $queryBuilder->getQuery()->getResult();
    }

    public function getPreview($entity) {
        return array(
            'identity' => $entity->getId(),
            'title' => $entity->getTitle(),
            'description' => 'ta mère en slip',
            'image' => $entity->getWebPath()
        );
    }

}