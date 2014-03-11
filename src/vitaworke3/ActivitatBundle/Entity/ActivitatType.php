<?php

namespace vitaworke3\ActivitatBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivitatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Activitat')
            ->add('Titol')
            ->add('Subtitol')
            ->add('DiesCaducitat')
            ->add('Baixa')
            ->add('Activada')
         ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'vitaworke3\ActivitatBundle\Entity\Activitat'
        ));
    }

    public function getName()
    {
        return 'vitaworke3_activitatbundle_activitattype';
    }
}
