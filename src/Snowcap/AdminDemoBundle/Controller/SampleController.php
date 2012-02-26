<?php

namespace Snowcap\AdminDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SampleController extends Controller
{
    /**
     * @Route("/sample")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
