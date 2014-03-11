<?php

namespace vitaworke3\CalendariBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlanningNouType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('Activitat', 'genemu_jqueryselect2_entity',
            array(
                'class' => 'vitaworke3\ActivitatBundle\Entity\Activitat',
                 'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                             ->where('l.Baixa = 0')
                            ->andWhere('l.Activada = 1');
                            
                 },
                    'configs' => array(
                    'placeholder' => 'Selecciona Activitat',
                    'allowClear' => true,
                    'width'=>'300')
                 
                )
              )
            ->add('Baixa')
            ->add('DiesCaducitat')
            ->add('Enviar')
            ->add('Enviada')
            ->add('Oberta')
            ->add('Valorada')
            ->add('assumpte')
            ->add('titol1')
            ->add('titol2')
            ->add('nick')
            ->add('contingut', 'textarea', array('attr' => array('cols' => '70', 'rows' => '10'), 'required' => false))
            ->add('Valoracio', 'choice', array('choices'   => array(
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',),
    'multiple'  => false,
    'expanded'  => true,
    'required' =>false,
));
         
              


    
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
