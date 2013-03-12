<?php

namespace Snowcap\DatalistDemoBundle\Controller;

use Snowcap\AdminBundle\Datalist\DatalistFactory;
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
     * @Route("/games", name="snowcap_datalistdemo_games")
     * @Template("SnowcapDatalistDemoBundle:Default:games.html.twig")
     */
    public function gamesAction()
    {
        $datalistFactory = $this->get('snowcap_admin.datalist_factory'); /** @var DatalistFactory $datalistFactory */
        $datalist = $datalistFactory
            ->createBuilder('datalist')
            ->addField('name', 'text')
            ->addField('awesome', 'boolean')
            ->addField('publishedOn', 'datetime', array('format' => 'd J s'))
            ->addField('type', 'label', array(
                'mappings' => array(
                    'rts' => array(
                        'label' => 'Real-time strategy',
                        'attr' => array('class' => 'label label-success')
                    ),
                    'fps' => array(
                        'label' => 'First-person shooter',
                        'attr' => array('class' => 'label label-warning')
                    ),
                    'rpg' => array(
                        'label' => 'Role-playing game',
                        'attr' => array('class' => 'label label-reverse')
                    ),
                )
            ))
            ->getDatalist();

        $dataSource = new ArrayDatasource(array(
            array('name' => 'Starcraft2', 'type' => 'rts', 'awesome' => true, 'publishedOn' => new \DateTime('2010-05-02')),
            array('name' => 'Diablo 3', 'type' => 'rpg', 'awesome' => false, 'publishedOn' => new \DateTime('2012-10-04')),
            array('name' => 'Command & Conquer', 'type' => 'rts', 'awesome' => false, 'publishedOn' => new \DateTime('1997-03-08')),
            array('name' => 'Counter Strike', 'type' => 'fps', 'awesome' => true, 'publishedOn' => new \DateTime('2001-10-20')),
            array('name' => 'Battlefield 5', 'type' => 'fps', 'awesome' => false, 'publishedOn' => new \DateTime('2013-08-02')),
        ));
        $datalist->setDatasource($dataSource);

        return array(
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
