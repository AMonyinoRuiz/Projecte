<?php

 namespace vitaworke3\ClientBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class TipusClientAdmin extends Admin
{
   protected function configureListFields(ListMapper $mapper)
	{	
		$mapper
		->add('TipusClient')
		;
	}
	protected function configureDatagridFilters(DatagridMapper $mapper)
	{
		$mapper
		->add('TipusClient')
		;
	}
	protected function configureFormFields(FormMapper $mapper)
	{
		$mapper
		->add('TipusClient')
		;
	}
}