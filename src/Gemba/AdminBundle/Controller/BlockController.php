<?php

namespace Gemba\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlockController extends Controller
{
    /**
     * @Route("/" , name="block_home")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $dispatcher = $this->get('event_dispatcher');
        $em = $this->getDoctrine()->getManager();

        $blocks = $this->get('block')->findAllOrderBy('sort');

        $block = $this->get('entity_factory')->create('block');
        $type = $this->get('type_factory')->create('block');
        $form = $this->createForm($type , $block);
        $form->handleRequest($request);

        if($form->isValid())
        {
            if(count($blocks) >= 7)
            {
                $this->addFlash('danger' , '已经不能添加模块了');
                return $this->redirectToRoute('block_home');
            }

            $event = new FormEvent($form , $block);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $em->persist($block);
            $em->flush();

            $this->addFlash('success' , '模块添加成功');
            return $this->redirectToRoute('block_home');
        }

        return [
            'form' => $form->createView() ,
            'blocks' => $blocks
        ];
    }

    /**
     * @Route("/{id}/sub" , name="sub_block_home")
     * @Template()
     */

     public function subblockAction(Request $request , $id)
     {
         $dispatcher = $this->get('event_dispatcher');
         $em = $this->getDoctrine()->getManager();

         $block = $this->get('block')->find($id);
         $type = $this->get('type_factory')->create('block');
         $form = $this->createForm($type, $block);
         $form->handleRequest($request);
         if($form->isValid())
         {
             $event = new FormEvent($form , $block);
             $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

             $em->persist($block);
             $em->flush();

             $this->addFlash('success' , '模块更新成功');
             return $this->redirectToRoute('sub_block_home' , ['id'=>$id]);
         }


         return [
             'form' => $form->createView() ,
         ];
     }

}
