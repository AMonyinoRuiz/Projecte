<?php

namespace vitaworke3\UsuarisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditFormType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('roles', 'choice', array('label' => 'Rol', 'required' => true, 'choices' => array( 1 => 'ROLE_ADMIN', 2 => 'ROLE_USER'), 'multiple' => true))
            ->add('enabled', 'checkbox', array('label' => 'Actiu','required'  => false,));
        
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
       
        $resolver->setDefaults(array(
            'data_class' => 'vitaworke3\UsuarisBundle\Entity\Usuari'
        ));
    }

    public function getName()
    {
        return 'vitaworke3_usuarisbundle_editformtype';
    }
}