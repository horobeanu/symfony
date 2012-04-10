<?php

namespace webCS\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use webCS\AdminBundle\Entity\User;

class LoadAdminUserData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('horobeanu@yahoo.com');
        $user->setPlainPassword('a');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setEnabled(true);

        $manager->persist($user);
        $manager->flush();
    }
}