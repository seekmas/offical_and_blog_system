<?php

namespace Gemba\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject' , null , ['label' => '标题'])
            ->add('content' , null , ['label' => '内容'])
            ->add('keywords' , null , ['label' => '关键字'])
            ->add('meta' , null , ['label' => ''])
            ->add('description' , null , ['label' => 'SEO描述'])
            ->add('title' , null , ['label' => '网页标题'])
            ->add('publish' , null , ['label' => '是否发布'])
            ->add('createdAt' , null , ['label' => '创建日期' , 'widget' => 'single_text'])
            ->add('category' , null , ['label' => '年份分类'])
            ->add('file' , 'file' , ['label' => '封面图' , 'required' => false])
            ->add('click' , null , ['label' => '点击量'])
        ;

        $builder->add('save' , 'submit' , ['label' => '发布']);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gemba\AdminBundle\Entity\News'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gemba_adminbundle_news';
    }
}
