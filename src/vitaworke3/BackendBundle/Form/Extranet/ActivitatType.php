<?php

namespace vitaworke3\BackendBundle\Form\Extranet;

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
            ->add('Tipologia')
            ->add('Format')
            ->add('Comite', 'entity',
            array('label' => 'Comite',
                'class' => 'vitaworke3\ClientBundle\Entity\Client',
                 'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 3');
                            
                 }
                )
              )

            ->add('Formador','entity',
            array('label' => 'Formador',
                'class' => 'vitaworke3\ClientBundle\Entity\Client',
                 'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 4');
                            
                 }
                 )
               )

              ->add('Text1', 'textarea', array('attr' => array('cols' => '38', 'rows' => '10'), 'required' => false))
              ->add('Text2', 'textarea', array('attr' => array('cols' => '38', 'rows' => '10'),'required' => false))
              ->add('Text3', 'textarea', array('attr' => array('cols' => '38', 'rows' => '10'),'required' => false))
              ->add('Text4', 'textarea', array('attr' => array('cols' => '38', 'rows' => '10'),'required' => false))
              ->add('Text5', 'textarea', array('attr' => array('cols' => '38', 'rows' => '10'),'required' => false))
              ->add('Text6', 'textarea', array('attr' => array('cols' => '38', 'rows' => '10'),'required' => false))
              ->add('Text7', 'textarea', array('attr' => array('cols' => '38', 'rows' => '10'),'required' => false))
              ->add('Text8', 'textarea', array('attr' => array('cols' => '38', 'rows' => '10'),'required' => false))
              ->add('TipusCamp1')
              ->add('TipusCamp2')
              ->add('TipusCamp3')
              ->add('TipusCamp4')
              ->add('TipusCamp5')
              ->add('TipusCamp6')
              ->add('TipusCamp7')
              ->add('TipusCamp8')
              ->add('assumpte')
              ->add('titol1')
              ->add('titol2')
              ->add('nick')
              ->add('contingut', 'textarea', array('attr' => array('cols' => '70', 'rows' => '10'), 'required' => false))
          
             

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
