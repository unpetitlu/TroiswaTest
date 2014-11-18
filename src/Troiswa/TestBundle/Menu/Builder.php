<?php

namespace Troiswa\TestBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'troiswa_test_homepage'));
        $menu->addChild('Acteurs', array('route' => 'actor'));
        $menu->addChild('Films', array('route' => 'movie'));
        // $menu->addChild('About Me', array(
        //     'route' => 'page_show',
        //     'routeParameters' => array('id' => 42)
        // ));

        return $menu;
    }
}