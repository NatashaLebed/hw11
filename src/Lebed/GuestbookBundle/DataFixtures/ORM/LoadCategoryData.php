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
        $symfony = new Category();
        $symfony->setTitle('Symfony2');

            $doctrine = new Category();
            $doctrine->setTitle('Databases and Doctrine');
            $doctrine->setParent($symfony);

                $conf = new Category();
                $conf->setTitle('Configuration and basic usage');
                $conf->setParent($doctrine);

                $doctrine_extension = new Category();
                $doctrine_extension->setTitle('Doctrine Extensions');
                $doctrine_extension->setParent($doctrine);

            $templates = new Category();
            $templates->setTitle('Templates');
            $templates->setParent($symfony);

                $twig = new Category();
                $twig->setTitle('Twig');
                $twig->setParent($templates);

                    $twig_extension = new Category();
                    $twig_extension->setTitle('Twig Extension');
                    $twig_extension->setParent($twig);

                $template_service = new Category();
                $template_service->setTitle('Templating Service');
                $template_service->setParent($templates);

        $manager->persist($symfony);
        $manager->persist($doctrine);
        $manager->persist($conf);
        $manager->persist($doctrine_extension);
        $manager->persist($templates);
        $manager->persist($twig);
        $manager->persist($twig_extension);
        $manager->persist($template_service);

        $manager->flush();

        $this->addReference('configuration-and-basic-usage', $conf);
        $this->addReference('doctrine-extensions', $doctrine_extension);
        $this->addReference('templates', $templates);
        $this->addReference('twig', $twig);
        $this->addReference('twig-extension', $twig_extension);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}