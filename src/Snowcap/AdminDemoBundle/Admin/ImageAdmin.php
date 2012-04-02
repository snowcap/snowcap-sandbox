<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;

use Snowcap\AdminBundle\Admin\TranslatableContentAdmin;
use Snowcap\AdminDemoBundle\Form\ImageType;
use Snowcap\AdminDemoBundle\Form\ImageTranslationType;

class ImageAdmin extends TranslatableContentAdmin
{

    public function getDatalist()
    {
        $datalist = $this->createDatalist('thumbnail', 'image');
        $datalist
            ->add('path', 'image')
            ->add('translations[%locale%].title', 'label');
        return $datalist;
    }

    public function getForm($data = null)
    {
        return $this->createForm(new ImageType(), $data);
    }

    public function getTranslationForm($data = null)
    {
        return $this->createForm(new ImageTranslationType(), $data);
    }

    public function getSearchForm()
    {
        $builder = $this->environment->get('form.factory')->createBuilder('search')
            ->add('e.translations[en].title', 'text');
        return $builder->getForm();
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