<?php

namespace Snowcap\DatalistDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Snowcap\AdminBundle\Datalist\Datasource\DoctrineORMDatasource;
use Snowcap\AdminBundle\Datalist\Datasource\ArrayDatasource;

/**
 * @Route("/datalist")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Template("SnowcapDatalistDemoBundle:Default:datalist.html.twig")
     */
    public function datalist1Action()
    {
        $datalist = $this->getDatalistFactory()->createBuilder('datalist', array('data_class' => 'Snowcap\DatalistDemoBundle\Entity\Player'))
            ->addField('firstName')
            ->addField('lastName')
            ->getDatalist();

        $queryBuilder = $this->getDoctrine()->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from('SnowcapDatalistDemoBundle:Player', 'p');
        $datasource = new DoctrineORMDatasource($queryBuilder);
        $datasource
            ->paginate()
            ->setPage(1);

        $datalist->setDataSource($datasource);

        return array(
            'datalist_title' => 'Regular datalist with Doctrine ORM datasource',
            'datalist' => $datalist,
        );
    }

    /**
     * @Template("SnowcapDatalistDemoBundle:Default:datalist.html.twig")
     */
    public function datalist2Action()
    {
        $datalist = $this->getDatalistFactory()->createBuilder()
            ->addField('player')
            ->addField('score')
            ->getDatalist();

        $datasource = new ArrayDatasource(array(
            array(
                'player' => 'PIE',
                'score' => 5000,
            ),
            array(
                'player' => 'JER',
                'score' => 4900,
            ),
            array(
                'player' => 'JER',
                'score' => 4800,
            ),
            array(
                'player' => 'PIE',
                'score' => 4400,
            ),
            array(
                'player' => 'EDW',
                'score' => 4300,
            ),
            array(
                'player' => 'ABD',
                'score' => 4200,
            ),
            array(
                'player' => 'JER',
                'score' => 4100,
            ),
            array(
                'player' => 'ABD',
                'score' => 3845,
            ),
            array(
                'player' => 'EDW',
                'score' => 3680,
            ),
            array(
                'player' => 'PIE',
                'score' => 3360,
            ),
            array(
                'player' => 'JER',
                'score' => 3250,
            ),
            array(
                'player' => 'EDW',
                'score' => 3200,
            ),
            array(
                'player' => 'JER',
                'score' => 3000,
            ),
        ));
        $datalist->setDatasource($datasource);

        return array(
            'datalist_title' => 'Regular datalist with array datasource',
            'datalist' => $datalist
        );
    }

    /**
     * @return \Snowcap\AdminBundle\Datalist\DatalistFactory
     */
    private function getDatalistFactory()
    {
        return $this->get('snowcap_admin.datalist_factory');
    }
}
