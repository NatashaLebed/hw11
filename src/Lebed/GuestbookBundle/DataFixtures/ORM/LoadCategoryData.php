<?php

namespace Lebed\GuestbookBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Lebed\GuestbookBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
            date_default_timezone_set('Europe/Kiev');

            $category1 = new Category();
            $category1->setTitle('Databases and Doctrine');
            $manager->persist($category1);

            $category2 = new Category();
            $category2->setTitle('Testing');
            $manager->persist($category2);


            $category3 = new Category();
            $category3->setTitle('Security');
            $manager->persist($category3);


            $category4 = new Category();
            $category4->setTitle('Service Container');
            $manager->persist($category4);


            $manager->flush();
        $this->addReference('databases-and-doctrine-category', $category1);
        $this->addReference('testing-category', $category2);
        $this->addReference('security-category', $category3);
        $this->addReference('service-container-category', $category4);

    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}