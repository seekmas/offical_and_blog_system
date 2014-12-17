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
            ->add('subject')
            ->add('lTitle')
            ->add('lContent')
            ->add('rTitle')
            ->add('rContent')
            ->add('link')
            ->add('sort')
        ;

        $builder->add('save' , 'submit');
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
