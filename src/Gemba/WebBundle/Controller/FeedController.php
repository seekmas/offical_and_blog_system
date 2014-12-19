<?php

namespace Gemba\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;

class FeedController extends Controller
{
    /**
     * @Route("/" , name="feed_home")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $news_list = $this->get('news')
                          ->createQueryBuilder('news')
                          ->select('news')
                          ->where('news.publish = 1')
                          ->orderBy('news.id' , 'desc')
                          ->getQuery();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $news_list,
            $request->query->get('page', 1)/*page number*/,
            20
        );

        return [
            'list' => $pagination ,
        ];
    }

    /**
     * @Route("/{id}/read" , name="feed_read")
     * @Template()
     */
    public function readAction(Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

        $feed = $this->get('news')->find($id);
        if($feed == NULL)
        {
            $this->addFlash('error' , '没有找的相应的新闻');
            return $this->redirectToRoute('feed_home');
        }

        $feed->setClick($feed->getClick()+1);
        $em->persist($feed);
        $em->flush();

        $comment = $this->get('entity_factory')->create('newsComment');
        $type = $this->get('type_factory')->create('newsComment');
        $form = $this->createForm($type , $comment);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $event = new FormEvent($form , $comment);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $comment->setNews($feed);

            $em->persist($comment);
            $em->flush();

            $this->addFlash('success' , '评论成功');
            return $this->redirectToRoute('feed_read' , ['id'=> $id]);
        }

        return [
            'feed' => $feed ,
            'form' => $form->createView() ,
        ];
    }
}