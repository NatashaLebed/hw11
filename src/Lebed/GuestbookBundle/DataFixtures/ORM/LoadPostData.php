<?php

namespace Lebed\GuestbookBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Lebed\GuestbookBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        date_default_timezone_set('Europe/Kiev');
        $post = new Post();
        $post->setTitle('Doctrine Fixtures Bundle');
        $post->setAuthor('Natasha');
        $post->setCategory($this->getReference('configuration-and-basic-usage'));
        $post->setText('Fixtures are used to load a controlled set of data into a database. This data can be used for testing or could be the initial data required for the application to run smoothly. Symfony2 has no built in way to manage fixtures but Doctrine2 has a library to help you write fixtures for the Doctrine ORM or ODM. Writing a basic fixture is simple. But what if you have multiple fixture classes and want to be able to refer to the data loaded in other fixture classes? For example, what if you load a User object in one fixture, and then want to refer to reference it in a different fixture in order to assign that user to a particular group?');
        $manager->persist($post);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
