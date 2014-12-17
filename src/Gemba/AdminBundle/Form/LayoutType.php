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
            ->add('subject')
            ->add('layout' , 'choice' ,
                [
                    'choices'   =>
                        [
                            'one_column' => 'One Column',
                            'two_column' => 'Two Column',
                            'three_column' => 'Three Column' ,
                            'four_column'  => 'Four Column' ,
                        ],
                ]
            )
            ->add('block')
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
