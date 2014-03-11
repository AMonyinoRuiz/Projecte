<?php

namespace vitaworke3\ActivitatBundle\Form;

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
            
            ->add('Tipologia','genemu_jqueryselect2_entity',
            array('class' => 'vitaworke3\ActivitatBundle\Entity\Tipologia',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.Baixa <> 1');
                            
                 },
                'required'=> false,
                'configs' => array(
                    'placeholder' => 'Selecciona Tipologia',
                    'allowClear' => true,
                    'width'=>'200')
                 
                )
              )
            ->add('Format','genemu_jqueryselect2_entity',
            array('label' => 'Format',
                'class' => 'vitaworke3\ActivitatBundle\Entity\Format',
                 'required'    => false,
                 'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.Baixa <> 1');
                            
                 },
                'configs' => array(
                      'placeholder' => 'Selecciona Format',
                    'allowClear' => true,
                    'width'=>'200')
                 
                )
              )
            ->add('Comite', 'genemu_jqueryselect2_entity',
            array('label' => 'Comite',
                'class' => 'vitaworke3\ClientBundle\Entity\Client',
                 'required'    => false,
                 'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 3');
                            
                 },
                'configs' => array(
                      'placeholder' => 'Selecciona Comite',
                    'allowClear' => true,
                    'width'=>'200')
                 
                )
              )

            ->add('Formador','genemu_jqueryselect2_entity',
            array('label' => 'Formador',
                'class' => 'vitaworke3\ClientBundle\Entity\Client',
                 'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 4');
                            
                 } ,
                    'required'    => false,
                    'configs' => array(
                    'placeholder' => 'Selecciona Formador',
                    'allowClear' => true,
                    'width'=>'200')
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
              ->add('TipusCamp1','genemu_jqueryselect2_entity',
                array('class' => 'vitaworke3\ActivitatBundle\Entity\TipusCamp',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository){
                    return $repository->createQueryBuilder('l')
                            ->where('l.Baixa <>1');
                   },'required' => false
                    ,'configs' => array(
                      'placeholder' => 'Sel. Tipus',
                    'allowClear' => true,
                    'width'=>'200'
                   )
                 )
               )
              ->add('TipusCamp2','genemu_jqueryselect2_entity',
                array('label' => 'Formador','class' => 'vitaworke3\ActivitatBundle\Entity\TipusCamp','query_builder' => function (\Doctrine\ORM\EntityRepository $repository){
                    return $repository->createQueryBuilder('l')
                            ->where('l.Baixa <>1');},'required' => false
                                    ,'configs' => array(
                      'placeholder' => 'Sel. Tipus',
                    'allowClear' => true,
                    'width'=>'200'
                   )
                 )
               )
              ->add('TipusCamp3','genemu_jqueryselect2_entity',
                array('label' => 'Formador','class' => 'vitaworke3\ActivitatBundle\Entity\TipusCamp',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository){
                    return $repository->createQueryBuilder('l')
                            ->where('l.Baixa <>1');
                   },'required' => false
                           ,'configs' => array(
                      'placeholder' => 'Sel. Tipus',
                    'allowClear' => true,
                    'width'=>'200'
                   )
                 )
               )
              ->add('TipusCamp4','genemu_jqueryselect2_entity',
                array('label' => 'Formador','class' => 'vitaworke3\ActivitatBundle\Entity\TipusCamp',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository){
                    return $repository->createQueryBuilder('l')
                            ->where('l.Baixa <>1');
                   },'required' => false
                           ,'configs' => array(
                      'placeholder' => 'Sel. Tipus',
                    'allowClear' => true,
                    'width'=>'200'
                   )
                 )
               )
              ->add('TipusCamp5','genemu_jqueryselect2_entity',
                array('label' => 'Formador','class' => 'vitaworke3\ActivitatBundle\Entity\TipusCamp',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository){
                    return $repository->createQueryBuilder('l')
                            ->where('l.Baixa <>1');
                   },'required' => false
                           ,'configs' => array(
                      'placeholder' => 'Sel. Tipus',
                    'allowClear' => true,
                    'width'=>'200'
                   )
                 )
               )
              ->add('TipusCamp6','genemu_jqueryselect2_entity',
                array('label' => 'Formador','class' => 'vitaworke3\ActivitatBundle\Entity\TipusCamp',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository){
                    return $repository->createQueryBuilder('l')
                            ->where('l.Baixa <>1');
                   },'required' => false
                           ,'configs' => array(
                      'placeholder' => 'Sel. Tipus',
                    'allowClear' => true,
                    'width'=>'200'
                   )
                 )
               )
              ->add('TipusCamp7','genemu_jqueryselect2_entity',
                array('label' => 'Formador','class' => 'vitaworke3\ActivitatBundle\Entity\TipusCamp',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository){
                    return $repository->createQueryBuilder('l')
                            ->where('l.Baixa <>1');
                   },'required' => false
                           ,'configs' => array(
                      'placeholder' => 'Sel. Tipus',
                    'allowClear' => true,
                    'width'=>'200'
                   )
                 )
               )
              ->add('TipusCamp8','genemu_jqueryselect2_entity',
                array('label' => 'Formador','class' => 'vitaworke3\ActivitatBundle\Entity\TipusCamp',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository){
                    return $repository->createQueryBuilder('l')
                            ->where('l.Baixa <>1');
                   },'required' => false
                           ,'configs' => array(
                      'placeholder' => 'Sel. Tipus',
                    'allowClear' => true,
                    'width'=>'200'
                   )
                 )
               )
              ->add('assumpte')
              ->add('titol1')
              ->add('titol2')
              ->add('nick')
              ->add('contingut', 'textarea', array('attr' => array('cols' => '70', 'rows' => '10'), 'required' => false))
              ->add('file')
              ->add('file2')
              ->add('file3')
              ->add('file4')
              ->add('file5')
              ->add('file6')
              ->add('file7')
              ->add('file8')
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
