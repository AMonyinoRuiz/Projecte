<?php

namespace vitaworke3\BackendBundle\Form\Extranet;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TestInicialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Pregunta1', 'choice', array('choices'   => array(
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7', ),
    'multiple'  => false,
    'expanded'  => true,
))
                 ->add('Pregunta2', 'choice', array('choices'   => array(
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7', ),
    'multiple'  => false,
    'expanded'  => true,
))
     ->add('Pregunta3', 'choice', array('choices'   => array(
         1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7', ),
    'multiple'  => false,
    'expanded'  => true,
))
     ->add('Pregunta4', 'choice', array('choices'   => array(
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7', ),
    'multiple'  => false,
    'expanded'  => true,
))
       ->add('Pregunta5', 'choice', array('choices'   => array(
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7', ),
    'multiple'  => false,
    'expanded'  => true,
))      ;
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
