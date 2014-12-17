<?php

namespace Gemba\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserinfoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name' , null , ['label'=>'名字'])
            ->add('email' , null , ['label'=>'E-mail'])
            ->add('experience' , null , ['label' => '工作经历'])
            ->add('skillList' , null , ['label' => '技能列表'])
            ->add('description' , null , ['label' => '自我介绍'])
            ->add('file' , 'file' , ['label' => '头像/照片' , 'required' => false])
        ;

        $builder->add('save' , 'submit');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gemba\AdminBundle\Entity\Userinfo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gemba_adminbundle_userinfo';
    }
}
