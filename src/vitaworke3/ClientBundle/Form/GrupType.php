<?php

namespace vitaworke3\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GrupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('DataAccesAutoritzatInici')
            ->add('DataAccesAutoritzatFi')
            ->add('Baixa')
             ->add('Associat', 'genemu_jqueryselect2_entity',
            array('class' => 'vitaworke3\ClientBundle\Entity\Client',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 1')
                            ->orwhere('l.TipusClient = 8')
                            ->andwhere('l.Baixa = 0');
                },
                'required' => false,
                'configs' => array(
                    'placeholder' => 'Selecciona Associat',
                    'allowClear' => true,
                    'width'=>'300')
                
                )
              )
              ->add('responsable', 'genemu_jqueryselect2_entity',
            array('class' => 'vitaworke3\ClientBundle\Entity\Client',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 3')
                            ->orwhere('l.TipusClient = 4')
                            ->andwhere('l.Baixa = 0');
                },
                'required' => false,
                'configs' => array(
                    'placeholder' => 'Selecciona Client',
                    'width' => '300',
                    'allowClear' => true
                    )
                
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
                    'width' => '300',
                    'allowClear' => true)
                
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
                    'width' => '300',
                    'allowClear' => true)
                
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
        return 'vitaworke3_clienttbundle_gruptype';
    }
}
