<?php

 namespace vitaworke3\UsuarisBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class UsuarisAdmin extends Admin
{
   
    protected function configureListFields(ListMapper $mapper)
	{	
		$mapper
		->add('id')
		->add('rol')
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
		->add('id')
		->add('rol')
		;
	}
	protected function configureFormFields(FormMapper $mapper)
	{
		$mapper
		->add('id')
		->add('rol')
		;
	}
}