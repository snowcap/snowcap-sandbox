<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\Query\Expr\Join;

use Snowcap\AdminBundle\Admin\TranslatableContentAdmin;
use Snowcap\AdminDemoBundle\Form\ImageType;
use Snowcap\AdminDemoBundle\Form\ImageTranslationType;
use Snowcap\AdminBundle\Admin\InlineAdminInterface;

class ImageAdmin extends TranslatableContentAdmin implements InlineAdminInterface
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

    public function filterAutocomplete($input) {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder
            ->leftJoin('e.translations', 'tr', Join::WITH, 'tr.locale = :locale')
            ->setParameter('locale', $this->environment->getWorkingLocale())
            ->add('where', $queryBuilder->expr()->like('tr.title', $queryBuilder->expr()->literal('%' . $input . '%')));
        return $queryBuilder->getQuery()->getResult();
    }

    public function getPreview() {
        return array(
            'identity' => 'id',
            'title' => 'translations[%locale%].title',
            'image' => 'path'
        );
    }

}