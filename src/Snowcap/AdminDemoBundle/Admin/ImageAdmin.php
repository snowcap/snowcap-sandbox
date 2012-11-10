<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

use Snowcap\AdminDemoBundle\Form\ImageType;
use Snowcap\AdminBundle\Admin\ContentAdmin;

class ImageAdmin extends ContentAdmin
{
    /**
     * @return \Snowcap\AdminBundle\Datalist\AbstractDatalist
     */
    public function getDatalist()
    {
        $datalist = $this->createDatalist('thumbnail', 'image');
        $datalist
            ->add('name', 'label')
            ->add('path', 'image');
        return $datalist;
    }

    /**
     * @param array $data
     * @return \Symfony\Component\Form\Form
     */
    public function getForm($data = null)
    {
        return $this->formFactory->create(new ImageType(), $data);
    }

    /**
     * @return string
     */
    public function getEntityClass()
    {
        return 'Snowcap\AdminDemoBundle\Entity\Image';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'image';
    }
}