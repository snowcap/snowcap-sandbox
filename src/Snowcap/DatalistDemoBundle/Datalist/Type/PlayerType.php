<?php

namespace Snowcap\DatalistDemoBundle\Datalist\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Snowcap\AdminBundle\Datalist\Type\AbstractDatalistType;
use Snowcap\AdminBundle\Datalist\DatalistBuilder;

class PlayerType extends AbstractDatalistType
{
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
            'searchable' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'snowcap_datalistdemo_player';
    }

}