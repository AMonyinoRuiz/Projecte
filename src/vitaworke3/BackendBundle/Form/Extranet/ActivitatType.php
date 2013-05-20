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
            ->add('Sinopsi')
            ->add('imatge', 'file', array(
                    'data_class' => 'Symfony\Component\HttpFoundation\File\File',
                    'required' => false))
            ->add('multimedia', 'file', array(
                    'data_class' => 'Symfony\Component\HttpFoundation\File\File',
                    'required' => false))
            ->add('Link')
            ->add('Html')
            
            ->add('DiesCaducitat')
            ->add('Presentacio')
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

        

       
        ;
        $builder->add('tags', 'collection', array('type' => new \vitaworke3\ActivitatBundle\Form\TagType(),'allow_add'    => true, 'by_reference'=>false,'allow_delete' => true,));
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
