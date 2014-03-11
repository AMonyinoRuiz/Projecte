<?php

namespace vitaworke3\ClientBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClientIdiomaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Client', 'entity',
            array('label' => 'Client',
                'class' => 'vitaworke3\ClientBundle\Entity\Client',
                 'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 1')
                            ->orWhere('l.TipusClient = 6');
                            
                 }
                )
              )
            ->add('nomtemplate')
            
            ->add('Idioma')
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
            'data_class' => 'vitaworke3\ClientBundle\Entity\ClientIdioma'
        ));
    }

    public function getName()
    {
        return 'vitaworke3_clientbundle_clientidiomatype';
    }
}
