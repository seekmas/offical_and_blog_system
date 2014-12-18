<?php

namespace Gemba\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LayoutController extends Controller
{
    /**
     * @Route("/" , name="layout_home")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

        $blocks = $this->get('block')->findAllOrderBy('sort', 'asc');

        $layout = $this->get('entity_factory')->create('layout');
        $type = $this->get('type_factory')->create('layout');
        $form = $this->createForm($type , $layout);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $layout);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $em->persist($layout);
            $em->flush();

            $this->addFlash('success' , '布局添加成功');
            return $this->redirectToRoute('layout_home');
        }


        return [
            'form' => $form->createView() ,
            'blocks' => $blocks
        ];
    }

    /**
     * @Route("/{id}/update" , name="layout_update")
     * @Template()
     */
    public function updateAction(Request $request , $id)
    {

        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

        $blocks = $this->get('block')->findAllOrderBy('sort', 'asc');

        $layout = $this->get('layout')->find($id);
        $type = $this->get('type_factory')->create('layout');
        $form = $this->createForm($type , $layout);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $layout);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $em->persist($layout);
            $em->flush();

            $this->addFlash('success' , '布局添加成功');
            return $this->redirectToRoute('layout_home');
        }


        return [
            'form' => $form->createView() ,
            'blocks' => $blocks
        ];
    }
    /**
     * @Route("/{id}/edit" , name="layout_edit")
     * @Template()
     */
    public function editAction(Request $request , $id)
    {
        $block = $this->get('block')->find($id);

        return ['block' => $block];
    }

    /**
     * @Route("/{id}/content_remove" , name="content_remove")
     * @Template()
     */
    public function removeContentAction(Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();

        $smalltext = $this->get('smalltext')->find($id);
        $block_id = $smalltext->getLayout()->getBlockId();
        $em->remove($smalltext);
        $em->flush();

        $this->addFlash('success' , '删除成功');
        return $this->redirectToRoute('layout_edit' , ['id' => $block_id]);
    }
}