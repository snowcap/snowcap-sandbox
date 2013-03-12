<?php

namespace Snowcap\DatalistDemoBundle\Datalist\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Snowcap\AdminBundle\Datalist\Type\AbstractDatalistType;
use Snowcap\AdminBundle\Datalist\DatalistBuilder;

class HighScoreType extends AbstractDatalistType
{
    /**
     * @param \Snowcap\AdminBundle\Datalist\DatalistBuilder $builder
     * @param array $options
     */
    public function buildDatalist(DatalistBuilder $builder, array $options)
    {
        parent::buildDatalist($builder, $options);

        $builder
            ->addField('player', 'heading')
            ->addField('score')
            ->addField('mode', 'label', array(
                'mappings' => $this->getModes(),
            ))
            ->addFilter('mode', 'choice', array(
                'choices' => $this->getModes(),
                'label' => 'Game mode'
            ));
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'limit_per_page' => 5,
            'search' => '[player]'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'snowcap_datalistdemo_highscore';
    }

    /**
     * @return string
     */
    public function getBlockName()
    {
        return 'datalist';
    }

    /**
     * @return array
     */
    private function getModes()
    {
        return array(
            'arcade' => array(
                'label' => 'Arcade'
            ),
            'time_attack' => array(
                'label' => 'Time attack'
            )
        );
    }

}