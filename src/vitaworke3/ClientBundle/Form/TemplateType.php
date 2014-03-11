<?php

namespace vitaworke3\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TemplateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Client', 'genemu_jqueryselect2_entity',
                  array('class' => 'vitaworke3\ClientBundle\Entity\Client',
                 'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                  {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 1')
                            ->orWhere('l.TipusClient = 6');
                            
                  },
                    'configs' => array(
                    'placeholder' => 'Selecciona Associat',
                    'allowClear' => true,
                    'width'=>'250')
                
                )
              )
            ->add('nomtemplate')
            ->add('Idioma', 'genemu_jqueryselect2_entity',
            array('label' => 'Idioma',
                'class' => 'vitaworke3\BackendBundle\Entity\Idioma',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                         ->where('l.Baixa = 0');
                },
               
                'configs' => array(
                    'placeholder' => 'Selecciona Idioma',
                    'width' => '250',
                    'allowClear' => true)
                
                )
              )
            ->add('assumpte')
            ->add('titol1')
            ->add('titol2')
            ->add('nick')
            ->add('contingut', 'textarea', array('attr' => array('cols' => '70', 'rows' => '10'), 'required' => false))
            ->add('Baixa')
             
          ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
       
        $resolver->setDefaults(array(
            'data_class' => 'vitaworke3\ClientBundle\Entity\Template'
        ));
    }

    public function getName()
    {
        return 'vitaworke3_clientbundle_templatetype';
    }
}
