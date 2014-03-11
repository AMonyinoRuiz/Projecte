<?php

 namespace vitaworke3\CalendariBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class CalendariAdmin extends Admin
{
	
	protected function configureListFields(ListMapper $mapper)
	{	
		$mapper
		->add('DiaActivitat')
		->add('Client')
		->add('Activitat')
		->add('Enviada')
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
		->add('DiaActivitat')
		->add('Client')
		->add('Activitat')
		->add('Enviada')
        
        ;
	}
	protected function configureFormFields(FormMapper $mapper)
	{
		$mapper
		->add('DiaActivitat')
		->add('Client')
		->add('Activitat')
		->add('Enviada')
        
        ;
	}
}