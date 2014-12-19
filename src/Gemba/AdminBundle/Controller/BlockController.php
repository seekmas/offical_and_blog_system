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

        $blocks = $this->get('block')
                       ->createQueryBuilder('block')
                       ->select('block')
                       ->where('block.parentId is NULL')
                       ->orderBy('block.sort' , 'asc')
                       ->getQuery()
                       ->getResult();

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
             return $this->redirectToRoute('block_home');
         }

         return [
             'form' => $form->createView() ,
             'block' => $block ,
         ];
     }

    /**
     * @Route("/{id}/add_sub/{sub_id}" , name="add_sub_block_home" , defaults={"sub_id": 0})
     * @Template()
     */

    public function subAction(Request $request , $id , $sub_id)
    {
        $dispatcher = $this->get('event_dispatcher');
        $em = $this->getDoctrine()->getManager();

        $block = $this->get('block')->find($id);

        if($block->getParent() == NULL)
        {
            $sub = ($sub_id != 0 ? $this->get('block')->find($sub_id) : $this->get('entity_factory')->create('block'));
            $type = $this->get('type_factory')->create('block');
            $form = $this->createForm($type , $sub);
            $form->handleRequest($request);
            if($form->isValid())
            {
                $event = new FormEvent($form , $sub);
                $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

                $sub->setParent($block);

                $em->persist($sub);
                $em->flush();

                $this->addFlash('success' , '子模块更新成功');
                return $this->redirectToRoute('block_home');
            }
        }else
        {
            $this->addFlash('success' , '子模块下面无法再添加子模块');
            return $this->redirectToRoute('block_home');
        }

        return [
            'form' => $form ? $form->createView() : null ,
        ];
    }
}
