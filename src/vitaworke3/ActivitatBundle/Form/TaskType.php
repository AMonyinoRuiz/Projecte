<?php

namespace vitaworke3\ActivitatBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description');

        $builder->add('tags', 'collection', array('type' => new TagType(),'allow_add'    => true, 'by_reference'=>false,'allow_delete' => true,));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'vitaworke3\ActivitatBundle\Entity\Task',
        ));
    }

    public function getName()
    {
        return 'task';
    }
}