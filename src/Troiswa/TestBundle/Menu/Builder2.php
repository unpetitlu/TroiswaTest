<?php

namespace Troiswa\TestBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder2 extends ContainerAware
{
    private $factory;

    private $em;

    public function __construct($factory, $em)
    {
        $this->factory = $factory;
        $this->em = $em;
    }

    public function secondMenu()
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', array('route' => 'troiswa_test_homepage'));
        
        $menu->addChild('Films', array('route' => 'movie'));
        $movies = $this->em->getRepository('TroiswaTestBundle:Movie')->findAll();
        foreach ($movies as $m)
        {
            $menu['Films']->addChild
            (
                'movie_'.$m->getId(),
                array(
                    'label' => $m->getTitre(),
                    'route' => 'movie_show',
                    'routeParameters' => array('id' => $m->getId())
                )
            );
        }

        $menu->addChild('Acteurs', array('route' => 'actor'));
        
        return $menu;
    }
}