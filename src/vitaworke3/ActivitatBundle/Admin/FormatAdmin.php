<?php

 namespace vitaworke3\ActivitatBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class FormatAdmin extends Admin
{
   protected function configureListFields(ListMapper $mapper)
	{	
		$mapper
		->add('format')
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
		->add('format')
		;
	}
	protected function configureFormFields(FormMapper $mapper)
	{
		$mapper
		->add('format')
		;
	}
}