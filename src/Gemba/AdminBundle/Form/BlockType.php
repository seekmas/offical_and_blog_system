<?php

namespace Gemba\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlockType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('subject' , null , ['label' => '模块标题'])
            ->add('description' , null , ['label' => '模块描述'])
            ->add('aliasForUrl' , null , ['label' => '模块链接别名'])
            ->add('sort' , null , ['label' => '序号'])
            ->add('keywords' , null , ['label' => 'meta keywords'])
            ->add('descriptions' , null , ['label' => 'meta descriptions'])
        ;

        $builder->add('save' , 'submit');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gemba\AdminBundle\Entity\Block'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gemba_adminbundle_block';
    }
}
