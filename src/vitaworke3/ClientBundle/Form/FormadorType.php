<?php

namespace vitaworke3\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FormadorType extends AbstractType
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
            array('class' => 'vitaworke3\ClientBundle\Entity\Client',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 3')
                            ->andwhere('l.Baixa = 0');
                },
                'required' => false,
                'configs' => array(
                    'placeholder' => 'Selecciona Comite',
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
