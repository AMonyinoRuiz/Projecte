<?php

 namespace vitaworke3\BackendBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class IdiomaAdmin extends Admin
{
   protected function configureListFields(ListMapper $mapper)
	{	
		$mapper
		->add('Idioma')
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
		->add('Idioma')
		->add('Baixa')
		;
	}
	protected function configureFormFields(FormMapper $mapper)
	{
		$mapper
		->add('Idioma')
		->add('Baixa')
		;
	}
}