<?php

namespace Snowcap\DatalistDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Faker\Factory as FakerFactory;

use Snowcap\AdminBundle\Datalist\Datasource\DoctrineORMDatasource;
use Snowcap\AdminBundle\Datalist\Datasource\ArrayDatasource;

/**
 * @Route("/datalist")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="snowcap_datalistdemo_default_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/datalist1", name="snowcap_datalistdemo_default_datalist1")
     * @Template("SnowcapDatalistDemoBundle:Default:datalist.html.twig")
     */
    public function datalist1Action()
    {
        $datalist = $this->getDatalistFactory()->createBuilder('datalist', array(
                'data_class' => 'Snowcap\DatalistDemoBundle\Entity\Player',
                'limit_per_page' => 10
            ))
            ->addField('firstName')
            ->addField('lastName')
            ->getDatalist();

        $queryBuilder = $this->getDoctrine()->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from('SnowcapDatalistDemoBundle:Player', 'p');
        $datasource = new DoctrineORMDatasource($queryBuilder);

        $datalist
            ->setDataSource($datasource)
            ->setPage($this->getRequest()->get('page'));

        return array(
            'datalist_title' => 'Regular datalist with Doctrine ORM datasource',
            'datalist' => $datalist,
        );
    }

    /**
     * @Route("/datalist2", name="snowcap_datalistdemo_default_datalist2")
     * @Template("SnowcapDatalistDemoBundle:Default:datalist.html.twig")
     */
    public function datalist2Action()
    {
        $faker = FakerFactory::create();

        $datalist = $this->getDatalistFactory()->createBuilder('datalist', array(
                'limit_per_page' => 5
            ))
            ->addField('player')
            ->addField('score')
            ->getDatalist();

        $items = array();
        for($i = 0; $i <= 23; ++$i) {
            $items[]= array(
                'player' => $faker->toUpper($faker->lexify('???')),
                'score' => $faker->numberBetween(100, 5000)
            );
        }
        usort($items, function($row1, $row2) {
            return $row1['score'] < $row2['score'];
        });

        $datasource = new ArrayDatasource($items);
        $datalist
            ->setDatasource($datasource)
            ->setPage($this->getRequest()->get('page'));

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
