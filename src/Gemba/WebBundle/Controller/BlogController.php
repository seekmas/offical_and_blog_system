<?php

namespace Gemba\WebBundle\Controller;

use Gemba\AdminBundle\Entity\Userinfo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BlogController extends Controller
{
    /**
     * @Route("/" , name="blog_home")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $query = $this->get('blog')
             ->createQueryBuilder('blog')
             ->select('blog')
             ->orderBy('blog.click' , 'desc')
             ->getQuery();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->get('page', 1)/*page number*/,
            10
        );

        $latest = $this->get('blog')->setLimit(10)->findAllOrderById();
        $comments = $this->get('comment')->setLimit(10)->findAllOrderById();

        return [
            'blogs' => $pagination ,
            'latest' => $latest ,
            'comments' => $comments
        ];
    }

    /**
     * @Route("/{id}/post" , name="post")
     * @Template()
     */
    public function postAction(Request $request , $id)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

        $post = $this->get('blog')->find($id);
        $post->setClick($post->getClick()+1);
        $em->persist($post);
        $em->flush();
        $latest = $this->get('blog')->setLimit(10)->findAllOrderById();

        $comment = $this->get('entity_factory')->create('comment');
        $comment->setBlog($post);
        $type = $this->get('type_factory')->create('comment');
        $form = $this->createForm($type , $comment);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $comment);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $em->persist($comment);
            $em->flush();

            $this->addFlash('success' , '评论发表成功');
            return $this->redirectToRoute('post' , ['id'=> $id]) ;
        }

        return [
            'post' => $post ,
            'latest' => $latest ,
            'form' => $form->createView() ,
        ];
    }

    /**
     * @Route("/{userId}/blog_list" , name="user_blog")
     * @Template()
     */
    public function userAction(Request $request , $userId)
    {

        $blogs = $this->get('blog')->findAllBy(['userId' => $userId]);

        return [
            'blogs' => $blogs
        ];

    }

    /**
     * @Route("/write_blog" , name="write_blog")
     * @Template()
     */
    public function writeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

        $blog = $this->get('entity_factory')->create('blog');
        $type = $this->get('type_factory')->create('blog');
        $form = $this->createForm($type , $blog);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $blog);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            $em->persist($blog);
            $em->flush();

            $this->addFlash('success' , '博客发表成功');
            return $this->redirectToRoute('write_blog');
        }



        $blogs = $this->get('blog')->findAll();


        return [
            'form' => $form->createView() ,
            'blogs' => $blogs ,
        ];
    }

    /**
     * @Route("/{id}/update_blog" , name="update_blog")
     * @Template()
     */
    public function updateAction(Request $request , $id)
    {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

        $blog = $this->get('blog')->find($id);

        if($blog->getUser() != $user)
        {
            $this->addFlash('error','不能编辑别人的博客');
            return $this->redirectToRoute('post' , ['id'=> $id]);
        }

        if($blog->getFile())
        {
            $file = $blog->getFile();
        }

        $blog->setFile(null);


        $type = $this->get('type_factory')->create('blog');
        $form = $this->createForm($type , $blog);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event = new FormEvent($form , $blog);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            if($file && !$blog->getFile())
            {
                $blog->setFile($file);
            }

            $em->persist($blog);
            $em->flush();

            $this->addFlash('success' , '博客更新成功');
            return $this->redirectToRoute('post' , ['id' => $id]);
        }

        $blogs = $this->get('blog')->findAll();

        return [
            'form' => $form->createView() ,
            'blogs' => $blogs ,
        ];
    }

    /**
     * @Route("/user_info" , name="user_info")
     * @Template()
     */
    public function userinfoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dispatcher = $this->get('event_dispatcher');

        $user = $this->getUser();


        $userinfo = $user->getUserinfo() ? $user->getUserinfo() : $this->get('entity_factory')->create('userinfo');

        $file = $userinfo->getFile();
        $userinfo->setFile(null);
        $type = $this->get('type_factory')->create('userinfo');
        $form = $this->createForm($type , $userinfo);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $event =  new FormEvent($form , $userinfo);
            $dispatcher->dispatch(FormEvents::POST_SUBMIT , $event);

            if($file && !$userinfo->getFile())
                $userinfo->setFile($file);

            $em->persist($userinfo);
            $em->flush();

            $this->addFlash('success' , '个人信息更新成功');
            return $this->redirectToRoute('user_info');
        }

        $info = $user->getUserinfo();


        return [
            'form' => $form->createView() ,
            'info' => $info ,
        ];
    }

}
