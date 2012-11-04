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
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * @param \Symfony\Component\Routing\RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
       $this->router = $router;
    }

    /**
     * @return \Snowcap\AdminBundle\Datalist\AbstractDatalist
     */
    public function getDatalist()
    {
        $datalist = $this->createDatalist('thumbnail', 'image');
        $datalist
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
    public function getDefaultUrl()
    {
        return $this->router->generate('snowcap_admin_image_index');
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