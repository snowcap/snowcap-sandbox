<?php

namespace Snowcap\AdminDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\CoreBundle\Manager\PaginatorManager;

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

    /**
     * @Route("/pagination", name="sample_pagination")
     * @Template()
     *
     * @return array
     */
    public function paginationAction()
    {

        /* @var Symfony\Component\HttpFoundation\Request $request */
        $request = $this->getRequest();

        /* @var \Doctrine\ORM\EntityManager $em */
        $em = $this->getDoctrine()->getEntityManager();

        $dql = "SELECT p FROM SnowcapAdminDemoBundle:Post p";
        $query = $em->createQuery($dql);

        $paginator = new PaginatorManager($query, $request->get('page'), 2);

        return array('paginator' => $paginator);
    }
}
