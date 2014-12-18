<?php

namespace Gemba\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LayoutType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject' , null , ['label' => '标题'])
            ->add('layout' , 'choice' ,
                [
                    'label' => '排列方式' ,
                    'choices'   =>
                        [
                            'one_column' => '一行一列',
                            'two_column' => '一行两列',
                            'three_column' => '一行三列' ,
                            'four_column'  => '一行四列' ,
                        ],
                ]
            )
            ->add('block' , null , ['label' => '所属模块'])
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
            'data_class' => 'Gemba\AdminBundle\Entity\Layout'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gemba_adminbundle_layout';
    }
}
