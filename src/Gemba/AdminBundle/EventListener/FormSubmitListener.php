<?php

namespace Gemba\AdminBundle\EventListener;

use Symfony\Component\Form\FormEvent;

class FormSubmitListener
{
    private $service_container;
    public function __construct($service_container)
    {
        $this->service_container = $service_container;
    }

    public function onSubmit(FormEvent $event)
    {
        $entity = $event->getData();

        if( method_exists($entity , 'getFile'))
        {
            if($file = $entity->getFile())
            {
                preg_match('/(.[a-zA-Z]+)$/' , $file->getClientOriginalName() , $match);

                $filename = md5($file->getClientOriginalName() . microtime() . mt_rand(0,999)) .$match[0];

                $file->move($this->service_container->get('kernel')->getRootDir().'/../web/attachments/' , $filename);

                $entity->setFile($filename);
            }
        }

        if(method_exists($entity , 'setUser'))
        {
            $user = $this->service_container->get('security.context')->getToken()->getUser();
            $entity->setUser($user);
        }

        if($entity->getId())
        {
            $entity->setUpdatedAt(new \Datetime());
        }else
        {
            if(method_exists($entity , 'setUser'))
            {
                $user = $this->service_container->get('security.context')->getToken()->getUser();
                $entity->setUser($user);
            }

            $entity->setCreatedAt(new \Datetime());
            $entity->setUpdatedAt(new \Datetime());
        }
    }
}
