<?php

namespace Lebed\GuestbookBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Lebed\GuestbookBundle\Entity\Message;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadMessageData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        date_default_timezone_set('Europe/Kiev');
        for ($i = 1; $i <= 10; $i++) {
            $message = new Message();

            $message->setAuthor('Vasya');
            $message->setMail('Vasya@mail.ru');
            $message->setMessage('Actually, this command is incredibly powerful. It compares what your database should look like (based on the mapping information of your entities) with how it actually looks, and generates the SQL statements needed to update the database to where it should be. In other words, if you add a new property with mapping metadata to Product and run this task again, it will generate the "alter table" statement needed to add that new column to the existing product table.');

            $manager->persist($message);
            $manager->flush($message);
        }


    }

    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}