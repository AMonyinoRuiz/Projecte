<?php

 namespace vitaworke3\ClientBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class ClientAdmin extends Admin
{
	protected $baseRoutePattern = 'client';
    protected $baseRouteName = 'vitaworke3\ClientBundle\Entity\Client';


    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->getQueryBuilder()
            ->andWhere('o.TipusClient = :TipusClient')
            ->setParameter('TipusClient', '2')
        ;
     
    return $query;
    }

    protected function configureListFields(ListMapper $mapper)
	{	
		$mapper
        
		->add('Nom')
		->add('Nick')
		->add('TipusClient')
		->add('Associat')
        ->add('Mail')
        ->add('Baixa')
        ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                         )
            ))
        ->add('Client',null, array(
           'admin_code' => 'sonata.vitaworke3.admin.client'))
        ;
	}
	protected function configureDatagridFilters(DatagridMapper $mapper)
	{
		$mapper
        ->add('Nom')
	    ->add('Nick')
		->add('TipusClient')
		->add('Associat')
        ->add('Mail')
        ->add('Baixa')
        ;
	}
	protected function configureFormFields(FormMapper $mapper)
	{
		$mapper
            ->add('Nom')
            ->add('Nick')
            ->add('Mail')
            ->add('DataAccesAutoritzatInici')
            ->add('DataAccesAutoritzatFi')
            ->add('Baixa')
            ->add('Associat', 'genemu_jqueryselect2_entity',
                    array('label' => 'Associat',
                    'class' => 'vitaworke3\ClientBundle\Entity\Client',
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                    {
                         return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 1')
                            ->orwhere('l.TipusClient = 8')
                            ->andwhere('l.Baixa = 0');
                    },
                    'admin_code'=>'sonata.vitaworke3.admin.client',
                    'multiple'=>true,
                    'required' => false,
                    'configs' => array(
                        'placeholder' => 'Selecciona Associat',
                        'allowClear' => true,
                        'width'=>'300')))
            ->addIdentifier('Client', null, array(
                    'admin_code' => 'sonata.vitaworke3.admin.client'
                ));
           
          
	}
}