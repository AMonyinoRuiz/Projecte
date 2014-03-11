<?php

 namespace vitaworke3\ActivitatBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class ActivitatAdmin extends Admin
{
   
    protected function configureListFields(ListMapper $mapper)
	{	
		$mapper
		->add('Activitat')
		->add('Titol')
		->add('Subtitol')
		->add('Tipologia')
        ->add('Format')
        ->add('Comite')
        ->add('Formador')
        ->add('Baixa')
		->add('Activada')
		->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                         )
            ))
        
		
		;
	}
	protected function configureDatagridFilters(DatagridMapper $mapper)
	{
		$mapper
		->add('Activitat')
		->add('Titol')
		->add('Subtitol')
		->add('Tipologia')
        ->add('Format')
        ->add('Comite')
        ->add('Formador')
        ->add('Baixa')
		->add('Activada')
		;
	}
	protected function configureFormFields(FormMapper $mapper)
	{
		$mapper
		->add('Activitat')
		->add('Titol')
		->add('Subtitol')
		->add('Tipologia')
        ->add('Format')
        ->add('Comite')
        ->add('Formador')
        ->add('Baixa')
		->add('Activada')
		;
	}
}