<?php

 namespace vitaworke3\ClientBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class ClientIdiomaAdmin extends Admin
{
   protected function configureListFields(ListMapper $mapper)
	{	
		$mapper
		->add('Client')
		->add('Idioma')
		->add('nomtemplate')
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
		->add('Client')
		->add('Idioma')
		;
	}
	protected function configureFormFields(FormMapper $mapper)
	{
		$mapper
		->add('Client')
		->add('Idioma')
		->add('nomtemplate')
		->add('assumpte')
		->add('titol1')
		->add('titol2')
		->add('nick')
		->add('contingut')
		->add('Baixa')
		
		;
	}
}