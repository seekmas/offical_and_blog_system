<?php

namespace Gemba\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/" , name="admin_home")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');
        $block = $this->get('block')->findOneBy(['aliasForUrl' => '/']);


        $seo = $this->get('seo')->find(1) ? $this->get('seo')->find(1) : $this->get('entity_factory')->create('seo');
        $seo_type = $this->get('type_factory')->create('seo');
        $seo_form = $this->createForm($seo_type , $seo);
        $seo_form->handleRequest($request);
        if($seo_form->isValid())
        {
            $event = new FormEvent($seo_form , $seo);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $em->persist($seo);
            $em->flush();

            $this->addFlash('success' , '更新Logo成功');
            return $this->redirectToRoute('admin_home');
        }

        $logo = $this->get('logo')->find(1) ? $this->get('logo')->find(1) : $this->get('entity_factory')->create('logo');
        $logo_type = $this->get('type_factory')->create('logo');
        $logo_form = $this->createForm($logo_type);
        $logo_form->handleRequest($request);
        if($logo_form->isValid())
        {
            $event = new FormEvent($logo_form , $logo);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $em->persist($logo);
            $em->flush();

            $this->addFlash('success' , '更新Logo成功');
            return $this->redirectToRoute('admin_home');
        }

        $copyright = $this->get('copyright')->find(1) ? $this->get('copyright')->find(1) : $this->get('entity_factory')->create('copyright');
        $copyright_type = $this->get('type_factory')->create('copyright');
        $copyright_form = $this->createForm($copyright_type , $copyright);
        $copyright_form->handleRequest($request);
        if($copyright_form->isValid())
        {
            $event = new FormEvent($copyright_form, $copyright);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $em->persist($copyright);
            $em->flush();

            $this->addFlash('success' , '更新成功');
            return $this->redirectToRoute('admin_home');
        }

        //slider form
        $slider = $this->get('entity_factory')->create('slider');
        $type = $this->get('type_factory')->create('slider');
        $form = $this->createForm($type, $slider);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $slider);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT, $event);

            $em->persist($slider);
            $em->flush();

            $this->addFlash('success', '添加成功');
            return $this->redirectToRoute('admin_home');
        }

        //Bottom form
        $bottom = $this->get('entity_factory')->create('bottom');
        $type = $this->get('type_factory')->create('bottom');
        $bottom_form = $this->createForm($type, $bottom);
        $bottom_form->handleRequest($request);

        if ($bottom_form->isValid()) {
            $event = new FormEvent($bottom_form, $bottom);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT, $event);

            $em->persist($bottom);
            $em->flush();

            $this->addFlash('success', '添加成功');
            return $this->redirectToRoute('admin_home');
        }


        $sliders = $this->get('slider')->findAll();
        $bottoms = $this->get('bottom')->findAll();

        return [
            'block' => $block,
            'logo' => $logo ,
            'layouts' => $block->getLayout(),
            'seo_form' => $seo_form->createView() ,
            'copyright_form' => $copyright_form->createView() ,
            'logo_form' => $logo_form->createView() ,
            'form' => $form->createView(),
            'bottom_form' => $bottom_form->createView(),
            'sliders' => $sliders,
            'bottoms' => $bottoms,
        ];
    }

    /**
     * @Route("/{id}/slider_edit" , name="slider_edit")
     * @Template()
     */
    public function sliderAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

        $block = $this->get('block')->findOneBy(['aliasForUrl' => '/']);

        $slider = $this->get('slider')->find($id);

        if ($slider->getFile()) {
            $file = $slider->getFile();
            $slider->setFile(null);
        }

        $type = $this->get('type_factory')->create('slider');
        $form = $this->createForm($type, $slider);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $slider);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT, $event);


            if ($file && !$slider->getFile()) {
                $slider->setFile($file);
            }

            $em->persist($slider);
            $em->flush();

            $this->addFlash('success', '更新成功');
            return $this->redirectToRoute('admin_home');
        }
        $slider->setFile($file);
        $sliders = $this->get('slider')->findAll();


        return [
            'block' => $block,
            'layouts' => $block->getLayout(),
            'form' => $form->createView(),
            'sliders' => $sliders,
        ];
    }

    /**
     * @Route("/{id}/bottom_edit" , name="bottom_edit")
     * @Template()
     */
    public function bottomAction(Request $request, $id)
    {
        $block = $this->get('block')->findOneBy(['aliasForUrl' => '/']);
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

        $bottom = $this->get('bottom')->find($id);
        $type = $this->get('type_factory')->create('bottom');
        $form = $this->createForm($type, $bottom);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $bottom);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT, $event);

            $em->persist($bottom);
            $em->flush();

            $this->addFlash('success', '添加成功');
            return $this->redirectToRoute('admin_home');
        }

        $bottoms = $this->get('bottom')->findAll();

        return [
            'block' => $block,
            'layouts' => $block->getLayout(),
            'form' => $form->createView() ,
            'bottoms' => $bottoms
        ];
    }

    /**
     * @Route("/{id}/slider_delete" , name="slider_delete")
     * @Template()
     */
    public function sliderDeleteAction($id)
    {
        $slider = $this->get('slider')->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($slider);
        $em->flush();
        $this->addFlash('success', '删除成功');
        return $this->redirectToRoute('admin_home');
    }

    /**
     * @Route("/{id}/bottom_delete" , name="bottom_delete")
     * @Template()
     */
    public function bottomDeleteAction($id)
    {
        $bottom = $this->get('bottom')->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($bottom);
        $em->flush();
        $this->addFlash('success', '删除成功');
        return $this->redirectToRoute('admin_home');
    }
}