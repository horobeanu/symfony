<?php
namespace webCS\FrontendBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Home', array('route' => 'homepage'));
        $menu->addChild('About us', array('route' => 'about'));
        $menu->addChild('FAQ', array('route' => 'faq'));
        
        return $menu;
    }
}