<?php
namespace webCS\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Statistics', array('route' => 'dashboard'));
        $menu->addChild('Static pages', array('route' => 'cms'));
        
//        $menu->addChild('Users', array('route' => 'users_admin'));
//        $menu->addChild('Partners', array(
//            'route' => 'partnership',
//            //'routeParameters' => array('id' => 42)
//        ));
        
        return $menu;
    }
}