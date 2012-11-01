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
            ->add('path', 'image')
            ->add('translations[%locale%].title', 'label');
        return $datalist;
    }

    /**
     * @param array $data
     * @return \Symfony\Component\Form\Form
     */
    public function getForm($data = null)
    {
        return $this->createForm(new ImageType(), $data);
    }

    /**
     * @return string
     */
    public function getDefaultUrl()
    {
        return $this->router->generate('snowcap_admindemo_image_index');
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

    /**
     * @param string $alias
     * @param \Symfony\Component\Routing\RouteCollection $routeCollection
     */
    public function addRoutes($alias, RouteCollection $routeCollection)
    {
        $defaults = array('_controller' => 'SnowcapAdminBundle:Content:index', 'alias' => $alias);
        $route = new Route('/images', $defaults);
        $routeCollection->add('snowcap_admindemo_image_index', $route);
    }
}