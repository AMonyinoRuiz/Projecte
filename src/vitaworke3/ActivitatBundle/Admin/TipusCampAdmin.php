<?php

 namespace vitaworke3\ActivitatBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class TipusCampAdmin extends Admin
{
   protected function configureListFields(ListMapper $mapper)
	{	
		$mapper
		->add('TipusCamp')
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
		->add('TipusCamp')
		->add('Baixa')
		;
	}
	protected function configureFormFields(FormMapper $mapper)
	{
		$mapper
		->add('TipusCamp')
		->add('Baixa')
		;
	}
}