<?php

namespace Lebed\GuestbookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lebed\GuestbookBundle\Entity\Message;
use Lebed\GuestbookBundle\Form\Type\MessageType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $message = new Message();
        $message->setAuthor('Natasha');
        $message->setMail('Natasha@mail.ru');
        $message->setMessage('Actually, this command is incredibly powerful. It compares what your database should look like (based on the mapping information of your entities) with how it actually looks, and generates the SQL statements needed to update the database to where it should be. In other words, if you add a new property with mapping metadata to Product and run this task again, it will generate the "alter table" statement needed to add that new column to the existing product table.');

        $em=$this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();

        return new Response('Created message id '.$message->getId());
    }

    public  function viewMessagesAction(Request $request)
    {
        $message = new Message();
        $date = new \DateTime('now', null);
        $message->setPostedDate($date);

        $form = $this->createForm(new MessageType(), $message);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirect($this->generateUrl('lebed_guestbook_viewMessages'));
        }

        $messages = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Message')
            ->findAll();

        if (!$messages) {
            throw $this->createNotFoundException(
                'No messages found'
            );
        }

//        return $this->render('LebedGuestbookBundle:Default:viewMessages.html.twig', array(
//            'messages' => $messages,
//            'form' => $form->createView(),
//        ));
          return new Response('Created message id ');
    }

}
