<?php

namespace vitaworke3\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('DataAccesAutoritzatInici')
            ->add('DataAccesAutoritzatFi')
            ->add('Baixa')
            ->add('responsable', 'genemu_jqueryselect2_entity',
            array('class' => 'vitaworke3\ClientBundle\Entity\Client',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 3')
                            ->orwhere('l.TipusClient = 4')
                            ->andwhere('l.Baixa = 0');
                },
                'multiple'=>true,
                'required' => false,
                'configs' => array(
                      'placeholder' => 'Selecciona Cap de Projecte',
                    'allowClear' => true,
                    'width'=>'300')
                
                )
              )
            ->add('Idioma', 'genemu_jqueryselect2_entity',
            array('label' => 'Idioma',
                'class' => 'vitaworke3\BackendBundle\Entity\Idioma',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                         ->where('l.Baixa = 0');
                },
                'required' => false,
                'configs' => array(
                      'placeholder' => 'Selecciona Idioma',
                    'allowClear' => true,
                    'width'=>'300')
                
                )
              )
             ->add('Template', 'genemu_jqueryselect2_entity',
            array('class' => 'vitaworke3\ClientBundle\Entity\Template',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                         ->where('l.Baixa = 0');
                },
                'required' => false,
                'configs' => array(
                  'placeholder' => 'Selecciona Plantilla',
                    'allowClear' => true,
                    'width'=>'300')
                
                )
              )
                      ;
    }
 public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
       
        $resolver->setDefaults(array(
            'data_class' => 'vitaworke3\ClientBundle\Entity\Client'
        ));
    }
    

    public function getName()
    {
        return 'vitaworke3_clienttbundle_clienttype';
    }
}
