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
        $datalist = $this->getDatalistFactory()->create('snowcap_datalistdemo_player');
        $datasource = new DoctrineORMDatasource($this->getPlayerQueryBuilder(), array(
            'search' => array('p.lastName', 'p.firstName')
        ));
        $datalist
            ->setDataSource($datasource)
            ->setPage($this->getRequest()->get('page'))
            ->bind($this->getRequest());

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
        $datalist = $this->getDatalistFactory()->create('snowcap_datalistdemo_highscore');

        $datasource = new ArrayDatasource($this->getItems(), array(
            'search' => 'player'
        ));

        $datalist
            ->setDatasource($datasource)
            ->setPage($this->getRequest()->get('page', 1))
            ->bind($this->getRequest());

        return array(
            'datalist_title' => 'Regular datalist with array datasource',
            'datalist' => $datalist
        );
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getPlayerQueryBuilder()
    {
        $queryBuilder = $this->getDoctrine()->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from('SnowcapDatalistDemoBundle:Player', 'p');

        return $queryBuilder;
    }

    /**
     * @return array
     */
    private function getItems()
    {
        $faker = FakerFactory::create();

        $players = array(
            'Pierre', 'Jerome', 'Edwin', 'Abdel'
        );

        $items = array();
        for($i = 0; $i <= 23; ++$i) {
            $items[]= array(
                'player' => $faker->toUpper($faker->randomElement($players)),
                'score' => $faker->numberBetween(100, 5000),
                'mode' => $faker->randomElement(array('arcade', 'time_attack'))
            );
        }
        usort($items, function($row1, $row2) {
            return $row1['score'] < $row2['score'];
        });

        return $items;
    }

    /**
     * @return \Snowcap\AdminBundle\Datalist\DatalistFactory
     */
    private function getDatalistFactory()
    {
        return $this->get('snowcap_admin.datalist_factory');
    }
}
