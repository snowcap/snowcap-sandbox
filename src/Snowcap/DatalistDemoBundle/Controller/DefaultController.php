<?php

namespace Snowcap\DatalistDemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Faker\Factory as FakerFactory;

use Snowcap\AdminBundle\Datalist\Datasource\DoctrineORMDatasource;
use Snowcap\AdminBundle\Datalist\Datasource\ArrayDatasource;

use Snowcap\DatalistDemoBundle\Entity\Player;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="snowcap_datalistdemo_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/players", name="snowcap_datalistdemo_players")
     * @Template("SnowcapDatalistDemoBundle:Default:datalist.html.twig")
     */
    public function playersAction()
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
     * @Route("/player/{player}", name="snowcap_datalistdemo_player")
     * @Template("SnowcapDatalistDemoBundle:Default:player.html.twig")
     */
    public function playerAction(Player $player)
    {
        return array('player' => $player);
    }

    /**
     * @Route("/high-scores", name="snowcap_datalistdemo_highscores")
     * @Template("SnowcapDatalistDemoBundle:Default:datalist.html.twig")
     */
    public function highScoresAction()
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
            ->select('p', 'c')
            ->from('SnowcapDatalistDemoBundle:Player', 'p')
            ->innerJoin('p.country', 'c');

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
