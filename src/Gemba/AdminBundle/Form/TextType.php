<?php

namespace Gemba\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TextType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject' , null , ['label' => '大标题'])
            ->add('content' , null , ['label' => '简介'])
            ->add('lTitle' , null , ['label' => '左栏标题'])
            ->add('lContent' , null , ['label' => '左栏内容'])
            ->add('rTitle' , null , ['label' => '右栏标题'])
            ->add('rContent' , null , ['label' => '右栏内容'])
            ->add('link' , null , ['label' => '链接'])
        ;

        $builder->add('save' , 'submit' , ['label' => '确定']);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gemba\AdminBundle\Entity\Smalltext'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gemba_adminbundle_smalltext';
    }
}
