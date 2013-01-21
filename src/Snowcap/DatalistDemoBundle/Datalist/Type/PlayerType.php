<?php

namespace Snowcap\DatalistDemoBundle\Datalist\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;

use Snowcap\AdminBundle\Datalist\Type\AbstractDatalistType;
use Snowcap\AdminBundle\Datalist\DatalistBuilder;

class PlayerType extends AbstractDatalistType
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param \Snowcap\AdminBundle\Datalist\DatalistBuilder $builder
     * @param array $options
     */
    public function buildDatalist(DatalistBuilder $builder, array $options)
    {
        parent::buildDatalist($builder, $options);

        $builder
            ->addField('lastName', 'text', array('label' => 'Last name'))
            ->addField('firstName', 'text', array('label' => 'First name'))
            ->addField('born', 'datetime', array(
                'label' => 'Born on',
                'format' => 'Y-m-d',
            ))
            ->addField('country.name', 'text', array('label' => 'Country'))
            ->addFilter('country', 'choice', array(
                'property_path' => 'c.code',
                'choices' => $this->getCountries()
            ))
            ->addAction('view', 'simple', array(
                'route' => 'snowcap_datalistdemo_player',
                'params' => array('player' => 'id')
            ));
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => 'Snowcap\DatalistDemoBundle\Entity\Player',
            'limit_per_page' => 10,
            'search' => array('p.firstName', 'p.lastName')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'snowcap_datalistdemo_player';
    }

    /**
     * @return array
     */
    private function getCountries() {
        $countries = $this->em->getRepository('SnowcapDatalistDemoBundle:Country')->findAll();
        $countryChoices = array();
        foreach($countries as $country) {
            $countryChoices[$country->getCode()] = $country->getName();
        }

        return $countryChoices;
    }
}