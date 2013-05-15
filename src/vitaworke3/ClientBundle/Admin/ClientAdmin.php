<?php

 namespace vitaworke3\ClientBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class ClientAdmin extends Admin
{
	
	protected function configureListFields(ListMapper $mapper)
	{	
		$mapper
		->add('Nom')
		->add('Nick')
		
		->add('TipusClient')
		->add('Associat')
        ->add('DataAccesAutoritzat')
        ->add('Mail')
        ->add('Baixa')
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
		->add('Nom')
	    ->add('Nick')
		->add('TipusClient')
		->add('Associat')
        ->add('DataAccesAutoritzat')
        ->add('Mail')
        ->add('Baixa')
        ;
	}
	protected function configureFormFields(FormMapper $mapper)
	{
		$mapper
		->add('Nom')
		->add('Nick')
		->add('TipusClient')
		->add('Associat')
        ->add('DataAccesAutoritzat')
        ->add('Mail')
        ->add('Baixa')
        ;
	}
}