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
            ->addField('pmop')
            ->addField('mode', 'label', array(
                'mappings' => $this->getModes()
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
            'searchable' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'snowcap_datalistdemo_highscore';
    }

    private function getModes()
    {
        return array(
            'arcade' => 'Arcade',
            'time_attack' => 'Time attack'
        );
    }

}