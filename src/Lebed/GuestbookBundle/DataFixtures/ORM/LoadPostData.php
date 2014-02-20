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

        $post1 = new Post();
        $post1->setTitle('Loggable');
        $post1->setAuthor('Makar');
        $post1->setCategory($this->getReference('doctrine-extensions'));
        $post1->setText("Loggable behavior tracks your record changes and is able to manage versions. Features:Automatic storage of log entries in database ORM and ODM support using same listener Can be nested with other behaviors Objects can be reverted to previous versions Annotation, Yaml and Xml mapping support for extensions");
        $manager->persist($post1);

        $post2 = new Post();
        $post2->setTitle('Creating and using Templates');
        $post2->setAuthor('Veronika');
        $post2->setCategory($this->getReference('templates'));
        $post2->setText('As you know, the controller is responsible for handling each request that comes into a Symfony2 application. In reality, the controller delegates most of the heavy work to other places so that code can be tested and reused. When a controller needs to generate HTML, CSS or any other content, it hands the work off to the templating engine. In this chapter, youll learn how to write powerful templates that can be used to return content to the user, populate email bodies, and more. Youll learn shortcuts, clever ways to extend templates and how to reuse template code.');
        $manager->persist($post2);

        $post3 = new Post();
        $post3->setTitle('Introduction');
        $post3->setAuthor('Tymofiy');
        $post3->setCategory($this->getReference('twig'));
        $post3->setText('This is the documentation for Twig, the flexible, fast, and secure template engine for PHP. If you have any exposure to other text-based template languages, such as Smarty, Django, or Jinja, you should feel right at home with Twig. Its both designer and developer friendly by sticking to PHPs principles and adding functionality useful for templating environments. The key-features are...');
        $manager->persist($post3);

        $post4 = new Post();
        $post4->setTitle('The Text Extension');
        $post4->setAuthor('Natasha');
        $post4->setCategory($this->getReference('twig-extension'));
        $post4->setText('The Text extension provides the following filters: truncate wordwrap nl2br');
        $manager->persist($post4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
