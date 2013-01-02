<?php

namespace Snowcap\DatalistDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\AdminBundle\Datalist\Datasource\DoctrineORMDatasource;

/**
 * @Route("/datagrid")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $datalistFactory = $this->getDatalistFactory();
        $datalist = $datalistFactory->createBuilder()
            ->addField('firstName')
            ->addField('lastName')
            ->getDatalist();

        $queryBuilder = $this->getDoctrine()->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from('SnowcapDatalistDemoBundle:Player', 'p');

        $datasource = new DoctrineORMDatasource($queryBuilder);

        $datalist->setDataSource($datasource);

        return array('datalist' => $datalist);
    }

    /**
     * @return \Snowcap\AdminBundle\Datalist\DatalistFactory
     */
    private function getDatalistFactory()
    {
        return $this->get('snowcap_admin.datalist_factory');
    }
}
