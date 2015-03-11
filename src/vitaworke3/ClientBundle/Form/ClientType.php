<?php

namespace vitaworke3\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom')
            ->add('Nick')
            ->add('Mail')
            ->add('DataAccesAutoritzatInici')
            ->add('DataAccesAutoritzatFi')
            ->add('Baixa')
             ->add('Associat', 'genemu_jqueryselect2_entity',
            array('label' => 'Associat',
                'class' => 'vitaworke3\ClientBundle\Entity\Client',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 1')
                            ->orwhere('l.TipusClient = 8')
                            ->andwhere('l.Baixa = 0');
                },
                'multiple'=>true,
                'required' => false,
                'configs' => array(
                      'placeholder' => 'Selecciona Associat',
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
