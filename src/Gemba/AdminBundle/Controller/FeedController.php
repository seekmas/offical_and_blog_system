<?php

namespace Gemba\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;

class FeedController extends Controller
{

    /**
     * @Route("/" , name="news_home")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

        $news_list = $this->get('news')
            ->createQueryBuilder('news')
            ->select('news')
            ->orderBy('news.id' , 'desc')
            ->getQuery();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $news_list,
            $request->query->get('page', 1)/*page number*/,
            20
        );

        $news = $this->get('entity_factory')->create('news');
        $type = $this->get('type_factory')->create('news');
        $form = $this->createForm($type , $news);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $event = new FormEvent($form , $news);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $em->persist($news);
            $em->flush();

            $this->addFlash('success' , '新闻添加成功');

            return $this->redirectToRoute('news_home');
        }

        return [
            'form' => $form->createView(),
            'list' => $pagination ,
        ];
    }
    /**
     * @Route("/{id}" , name="news_edit" , defaults={"id" = 0})
     * @Template()
     */
    public function editAction(Request $request , $id = 0)
    {

        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

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

        $news = ($id == 0 ? $this->get('entity_factory')->create('news'):$this->get('news')->find($id));
        $type = $this->get('type_factory')->create('news');

        if($news->getFile())
        {
            $file = $news->getFile();
            $news->setFile(NULL);
        }

        $form = $this->createForm($type , $news);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $news);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            if( isset($file) && !$news->getFile())
            {
                $news->setFile($file);
            }
            $em->persist($news);
            $em->flush();

            $this->addFlash('success' , '新闻更新成功');

            return $this->redirectToRoute('news_edit' , ['id' => $id]);
        }

        if( isset($file) && !$news->getFile())
        {
            $news->setFile($file);
        }

        return [
            'form' => $form->createView(),
            'list' => $pagination ,
        ];

    }
}