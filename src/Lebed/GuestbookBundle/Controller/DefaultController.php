<?php

namespace Lebed\GuestbookBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lebed\GuestbookBundle\Entity\Message;
use Lebed\GuestbookBundle\Entity\Post;
use Lebed\GuestbookBundle\Entity\Category;
use Lebed\GuestbookBundle\Form\Type\MessageType;
use Gedmo\Loggable\Entity\LogEntry;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Post')
            ->findAll();

        if (!$posts) {
            throw $this->createNotFoundException(
                'No posts found'
            );
        }

        return $this->render('LebedGuestbookBundle:Default:index.html.twig', array('posts'=>$posts));
    }

    public function showAction($slug)
    {
        $post = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Post')
            ->findOneBySlug($slug);

        //for test loggable
        $post->setTitle('New Title Super Title Super Kruper Paratruper');
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return $this->render('LebedGuestbookBundle:Default:show.html.twig', array('post'=>$post));

    }

    public  function viewMessagesAction(Request $request)
    {
        $message = new Message();

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

        return $this->render('LebedGuestbookBundle:Default:viewMessages.html.twig', array(
            'messages' => $messages,
            'form' => $form->createView(),
        ));
    }

    public function searchAction(Request $request)
    {
        $searcher=$this->get('searcher');
        $result = $searcher->search($request->get('search'));
        $repository = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Message');
        $query = $repository->createQueryBuilder('m')
            ->where('m.id IN (:ids)')
            ->setParameter('ids', $result)
            ->getQuery();
        $messages = $query->getResult();

        if (!$messages) {
            throw $this->createNotFoundException(
                'No messages found'
            );
        }

        return $this->render('LebedGuestbookBundle:Default:search.html.twig', array('messages' => $messages));
    }

    public function postPreviousVersionAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('Gedmo\Loggable\Entity\LogEntry');

//        $post = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Post')->find(1);
//        $post->setTitle('New Title Super Title Super Kruper Paratruper');
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($post);
//        $em->flush();

        $post = $em->find('LebedGuestbookBundle:Post', 1);
        $post_title_now = $post->getTitle();

        $logs = $repo->getLogEntries($post);
        $pos = count($logs)-1;
        $repo->revert($post, $pos);
        $em->persist($post);
        $em->flush();
        $post_title_previous = $post->getTitle();

        return $this->render('LebedGuestbookBundle:Default:postPreviousVersion.html.twig',
            array('post_title_now' => $post_title_now, 'post_title_previous' => $post_title_previous, 'post'=>$post));
    }

    public function categoryTreeAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('LebedGuestbookBundle:Category');
        $options = array(
            'decorate' => true,
            'nodeDecorator' => function($node) {
                    return '<a href="/category/'.$node['id'].'">'.$node['title'].'</a>';
                }
        );

        $htmlTree = $repo->childrenHierarchy(null, false,  $options);

        return new Response($htmlTree);

    }

    public function viewPostsOfCategoryAction($id)
    {
        $posts = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Post')
            ->findByCategory($id);

        if (!$posts) {
            throw $this->createNotFoundException(
                'No posts found'
            );
        }

        return $this->render('LebedGuestbookBundle:Default:index.html.twig', array('posts'=>$posts));
    }
}
