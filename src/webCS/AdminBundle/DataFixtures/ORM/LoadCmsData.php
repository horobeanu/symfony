<?php

namespace webCS\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use webCS\AdminBundle\Entity\Cms;

class LoadCmsData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $cms = new Cms();
        $cms->setName('About us');
        $cms->setDescription('<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'); 
        $cms->setSlug('about_the_directory');
        $manager->persist($cms);
        
        $cms = new Cms();
        $cms->setName('FAQ');
        $cms->setDescription('<p>Blank page FAQ</p>'); 
        $cms->setSlug('faq');
        $manager->persist($cms);
        
        $manager->flush();
    }
    

}