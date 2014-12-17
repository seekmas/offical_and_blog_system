<?php

namespace Gemba\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ContentController extends Controller
{
    /**
    * @Route("/{layout_id}/add_to_layout" , name="content_home")
    * @Template()
    */
    public function indexAction(Request $request , $layout_id)
    {
        return [
            'layout_id' => $layout_id
        ];
    }

    /**
     * @Route("/{content_id}/content_edit" , name="content_edit")
     * @Template()
     */
    public function editAction(Request $request , $content_id)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

        $content = $this->get('smalltext')->find($content_id);
        $style = $content->getStyle();

        if(method_exists($content , 'getFile'))
        {
            $file = $content->getFile();
        }

        if($style === 'highlight')
        {
            $type = $this->get('type_factory')->create('highlight');
        }elseif($style === 'smalltext')
        {
            $type = $this->get('type_factory')->create('smalltext');
        }elseif($style === 'text')
        {
            $type = $this->get('type_factory')->create('text');
        }else
        {
            $type = $this->get('type_factory')->create('left');
        }

        $form = $this->createForm($type , $content);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $event = new FormEvent($form , $content);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            if( !$content->getFile() && method_exists($content , 'getFile'))
            {
                $content->setFile($file);
            }

            $em->persist($content);
            $em->flush();

            $this->addFlash('success' , '更新成功');
            return $this->redirectToRoute('layout_edit' , ['id' => $content->getLayout()->getBlockId()]);
        }

        return [
            'form' => $form->createView() ,
        ];
    }

    /**
    * @Route("/{layout_id}/create_text" , name="create_text")
    * @Template()
    */
    public function textAction(Request $request , $layout_id)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');
        $layout = $this->get('layout')->find($layout_id);

        $text = $this->get('entity_factory')->create('smalltext');
        $type = $this->get('type_factory')->create('text');
        $form = $this->createForm($type, $text);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $event = new FormEvent($form , $text);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $text->setLayout($layout);
            $text->setStyle('text');

            $em->persist($text);
            $em->flush();

            $this->addFlash('success' , '内容创建成功');
            return $this->redirectToRoute('content_home' , ['layout_id' => $layout_id]);
        }

        return [
            'form' => $form->createView() ,
        ];
    }

    /**
    * @Route("/{layout_id}/create_smalltext" , name="create_smalltext")
    * @Template()
    */
    public function smalltextAction(Request $request , $layout_id)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');
        $layout = $this->get('layout')->find($layout_id);

        $smalltext = $this->get('entity_factory')->create('smalltext');
        $type = $this->get('type_factory')->create('smalltext');
        $form = $this->createForm($type , $smalltext);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $smalltext);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $smalltext->setLayout($layout);
            $smalltext->setStyle('smalltext');

            $em->persist($smalltext);
            $em->flush();

            $this->addFlash('success' , '内容创建成功');
            return $this->redirectToRoute('content_home' , ['layout_id' => $layout_id]);
        }

        return ['form' => $form->createView()] ;
    }

    /**
     * @Route("/{layout_id}/create_highlight" , name="create_highlight")
     * @Template()
     */
    public function highlightAction(Request $request , $layout_id)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');
        $layout = $this->get('layout')->find($layout_id);

        $smalltext = $this->get('entity_factory')->create('smalltext');
        $type = $this->get('type_factory')->create('highlight');
        $form = $this->createForm($type , $smalltext);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $smalltext);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $smalltext->setLayout($layout);
            $smalltext->setStyle('highlight');

            $em->persist($smalltext);
            $em->flush();

            $this->addFlash('success' , '内容创建成功');
            return $this->redirectToRoute('content_home' , ['layout_id' => $layout_id]);
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/{layout_id}/create_left" , name="create_left")
     * @Template()
     */
    public function leftAction(Request $request , $layout_id)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');
        $layout = $this->get('layout')->find($layout_id);

        $smalltext = $this->get('entity_factory')->create('smalltext');
        $type = $this->get('type_factory')->create('left');

        $form = $this->createForm($type , $smalltext);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $smalltext);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $smalltext->setLayout($layout);
            $smalltext->setStyle('left');

            $em->persist($smalltext);
            $em->flush();


            $this->addFlash('success' , '内容创建成功');
            return $this->redirectToRoute('content_home' , ['layout_id' => $layout_id]);
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/{layout_id}/create_right" , name="create_right")
     * @Template()
     */
    public function rightAction(Request $request , $layout_id)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');
        $layout = $this->get('layout')->find($layout_id);

        $smalltext = $this->get('entity_factory')->create('smalltext');
        $type = $this->get('type_factory')->create('left');

        $form = $this->createForm($type , $smalltext);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $smalltext);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $smalltext->setLayout($layout);
            $smalltext->setStyle('right');

            $em->persist($smalltext);
            $em->flush();


            $this->addFlash('success' , '内容创建成功');
            return $this->redirectToRoute('content_home' , ['layout_id' => $layout_id]);
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/{layout_id}/create_top" , name="create_top")
     * @Template()
     */
    public function topAction(Request $request , $layout_id)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');
        $layout = $this->get('layout')->find($layout_id);

        $smalltext = $this->get('entity_factory')->create('smalltext');
        $type = $this->get('type_factory')->create('left');

        $form = $this->createForm($type , $smalltext);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $smalltext);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $smalltext->setLayout($layout);
            $smalltext->setStyle('top');

            $em->persist($smalltext);
            $em->flush();


            $this->addFlash('success' , '内容创建成功');
            return $this->redirectToRoute('content_home' , ['layout_id' => $layout_id]);
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/{layout_id}/create_center" , name="create_center")
     * @Template()
     */
    public function centerAction(Request $request , $layout_id)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');
        $layout = $this->get('layout')->find($layout_id);

        $smalltext = $this->get('entity_factory')->create('smalltext');
        $type = $this->get('type_factory')->create('left');

        $form = $this->createForm($type , $smalltext);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $smalltext);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $smalltext->setLayout($layout);
            $smalltext->setStyle('center');

            $em->persist($smalltext);
            $em->flush();


            $this->addFlash('success' , '内容创建成功');
            return $this->redirectToRoute('content_home' , ['layout_id' => $layout_id]);
        }

        return ['form' => $form->createView()];
    }
}
