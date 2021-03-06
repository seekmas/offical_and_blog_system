<?php

namespace Gemba\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VideoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject' , null , ['label' => '视频标题'])
            ->add('content' , null , ['label' => '视频介绍'])
            ->add('file' , 'file' , ['data_class' => null , 'required' => false ])
            ->add('link' , null , ['label' => '视频文件链接'])
            ->add('lTitle' , 'integer' , ['label' => '播放器宽度'])
            ->add('rTitle' , 'integer' , ['label' => '播放器高度'])
            ->add('sort' , null , ['label' => '序号'])
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
