<?php

namespace Snowcap\DatalistDemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

use Nelmio\Alice\Fixtures;

class LoadData extends AbstractFixture {
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        Fixtures::load(__DIR__ . '/data/data.yml', $manager);
    }

}