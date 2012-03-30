<?php

namespace Snowcap\AdminDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;

use Snowcap\AdminBundle\Controller\WysiwygController as BaseWysiwygController;

/**
 * Provides controller to manage wysiwyg related content
 *
 */
class WysiwygController extends BaseWysiwygController
{

    /**
     * @return array
     */
    public function browserAction()
    {
        return $this->forward('SnowcapAdminDemoBundle:Wysiwyg:entities');
    }

    /**
     * @return array
     *
     * @Template()
     */
    public function entitiesAction()
    {
        parse_str($this->getRequest()->getQueryString(), $arguments);
        $images = $this->getDoctrine()->getRepository('SnowcapAdminDemoBundle:Image')->findAll();

        return array('images' => $images, 'arguments' => $arguments);
    }

    /**
     * @return array
     *
     * @Template()
     */
    public function filesAction()
    {
        parse_str($this->getRequest()->getQueryString(), $arguments);
        $finder = new Finder();
        $finder->files()->in($this->get('kernel')->getRootDir() . '/../web/uploads');

        return array('images' => $finder, 'arguments' => $arguments);
    }

    /**
     * @return array
     *
     * @Template()
     */
    public function uploadAction()
    {
        parse_str($this->getRequest()->getQueryString(), $arguments);
        /** @var $file \Symfony\Component\HttpFoundation\File\UploadedFile */
        $file = $this->getRequest()->files->get('upload');
        $tags = $this->getRequest()->get('tags');

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the target filename to move to
        $file->move($this->get('kernel')->getRootDir() . '/../web/uploads/images', $file->getClientOriginalName());

        // set the path property to the filename where you'ved saved the file
        $url = 'uploads/images/' . $file->getClientOriginalName();

        return array('url' => $url, 'arguments' => $arguments);
    }
}