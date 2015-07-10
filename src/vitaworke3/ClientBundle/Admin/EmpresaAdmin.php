<?php

 namespace vitaworke3\ClientBundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
class EmpresaAdmin extends Admin
{
	protected $baseRoutePattern = 'empresa';
  protected $baseRouteName = 'vitaworke3\ClientBundle\Entity\Client';

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->getQueryBuilder()
            ->andWhere('o.TipusClient = :TipusClient')
            ->setParameter('TipusClient', '1')
        ;
     
    return $query;
    }

  protected function configureListFields(ListMapper $mapper)
	{	
		$mapper
		->add('TipusClient')
		->add('Idioma')
    ->add('Template')
    ->add('Responsable',null, array('admin_code' => 'sonata.vitaworke3.admin.empresa'))
    ->add('Baixa')
    ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
    )));
	}
	protected function configureDatagridFilters(DatagridMapper $mapper)
  {
    $mapper
    ->add('Nom')
    ->add('TipusClient')
    ->add('Idioma')
    ->add('Template')
    ->add('Responsable',null, array('admin_code' => 'sonata.vitaworke3.admin.empresa'))
    ->add('Baixa');
  }

protected function configureFormFields(FormMapper $mapper)
  {
    $mapper
    ->add('Nom')
    ->add('DataAccesAutoritzatInici')
    ->add('DataAccesAutoritzatFi')
    ->add('Responsable', 'genemu_jqueryselect2_entity',
            array('class' => 'vitaworke3\ClientBundle\Entity\Client',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                            ->where('l.TipusClient = 3')
                            ->orwhere('l.TipusClient = 4')
                            ->andwhere('l.Baixa = 0');
                },
                'multiple'=>true,
                'required' => false,
                'configs' => array(
                      'placeholder' => 'Selecciona Cap de Projecte',
                    'allowClear' => true,
                    'width'=>'300')
              ,  'admin_code'=>'sonata.vitaworke3.admin.empresa'
              ))
    ->add('Idioma', 'genemu_jqueryselect2_entity',
            array('label' => 'Idioma',
                'class' => 'vitaworke3\BackendBundle\Entity\Idioma',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                         ->where('l.Baixa = 0');
                },
                'required' => false,
                'configs' => array(
                'placeholder' => 'Selecciona Idioma',
                'allowClear' => true,
                'width'=>'300')
                )
              )
    ->add('Template', 'genemu_jqueryselect2_entity',
            array('class' => 'vitaworke3\ClientBundle\Entity\Template',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $repository)
                 {
                     return $repository->createQueryBuilder('l')
                         ->where('l.Baixa = 0');
                },
                'required' => false,
                'configs' => array(
                  'placeholder' => 'Selecciona Plantilla',
                    'allowClear' => true,
                    'width'=>'300')
                
                )
              )
    ->add('Baixa');
  } 


}