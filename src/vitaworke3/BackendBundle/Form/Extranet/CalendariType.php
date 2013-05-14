<?php

namespace vitaworke3\BackendBundle\Form\Extranet;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CalendariType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DiaActivitat')
            ->add('Client', 'entity',
            array('label' => 'Client',
                'class' => 'vitaworke3\ClientBundle\Entity\Client',
                 'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 1')
                            ->orWhere('l.TipusClient = 2');
                            
                 }
                )
              )
            ->add('Activitat')
            ->add('Associats')
            ->add('Enviar')

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
       
        $resolver->setDefaults(array(
            'data_class' => 'vitaworke3\CalendariBundle\Entity\Calendari'
        ));
    }

    public function getName()
    {
        return 'vitaworke3_calendaribundle_calendaritype';
    }
}
