<?php

namespace vitaworke3\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use vitaworke3\ClientBundle\Entity\Client;
use vitaworke3\ClientBundle\Form\GrupType;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\SecurityContext;

class GrupController extends Controller
{
	
    public function GrupAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
		$associats = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();	
		$idiomas =$em->getRepository('ClientBundle:Client')->queryidiomas()->getResult();
    	$tipusComite = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
		$tipusFormador = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
	    $responsables = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusComite,$tipusFormador)->getResult();	
		$templates =$em->getRepository('ClientBundle:Client')->querytemplatesall()->getResult();
		$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$grup = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclients($tipusGrup))->getResult();
		return $this->render('ClientBundle:Grup:grup.html.twig', array(
		'grups' => $grup,
		'associats'=>$associats,
		'idassociat'=>'0',
		'idiomas'=>$idiomas,
		'ididioma'=>'0',
		'templates'=>$templates,
		'idtemplate'=>'0',
		'responsables'=>$responsables,
		'idresponsable'=>'0',
		'paginador'=>$paginador
		)); 
    }
	
	public function GrupFiltreAction($idassociat,$ididioma,$idtemplate,$idresponsable)
     {
       	$em = $this->getDoctrine()->getEntityManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
      	$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));

	    $associats = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();	
	  	$idiomas =$em->getRepository('ClientBundle:Client')->queryidiomas()->getResult();
    	$tipusComite = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
		$tipusFormador = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
	    $responsables = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusComite,$tipusFormador)->getResult();	
		$templates =$em->getRepository('ClientBundle:Client')->querytemplatesall()->getResult();
	  	$grup = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclientsfiltre($tipusGrup,$idassociat,$ididioma,$idtemplate,$idresponsable))->getResult();
		return $this->render('ClientBundle:Grup:grup.html.twig', array(
		'grups' => $grup,
		'associats'=>$associats,
		'idassociat'=>$idassociat,
		'idiomas'=>$idiomas,
		'ididioma'=>$ididioma,
		'templates'=>$templates,
		'idtemplate'=>$idtemplate,
		'responsables'=>$responsables,
		'idresponsable'=>$idresponsable,
		'paginador'=>$paginador
		));
	   
	  }


    public function GrupNouAction()
    {
        $peticion = $this->getRequest();
        $grup = new Client();
        $formulario = $this->createForm(new GrupType(), $grup);
        $em = $this->getDoctrine()->getEntityManager();
       	if ($peticion->getMethod() == 'POST') 
	   	{
			$formulario->bind($peticion);
			if ($formulario->isValid()) 
			{
				$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
				$grup->setTipusClient($tipusclient);
				$em->persist($grup);
				$em->flush();
				$id=$grup->getId();
				return $this->redirect($this->generateUrl('extranet_grup_editar',  array( 'id'=> $id)));
			
			}
		}
        
        return $this->render('ClientBundle:Grup:grupnou.html.twig', array('accion' =>'crear','formulario' => $formulario->createView()));
    }
	public function GrupEditarAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$grup = $em->getRepository('ClientBundle:Client')->find($id);
		if (!$grup) {throw $this->createNotFoundException('grup inexistent');}
		$formulario = $this->createForm(new GrupType(), $grup);
		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$em->persist($grup);
				$em->flush();
				return $this->redirect($this->generateUrl('extranet_grup_editar',  array( 'id'=> $id)));
		
			}
		}
		return $this->render('ClientBundle:Grup:grupnou.html.twig',
		array(
		'accion' =>'editar',
		'grup' => $grup,
		'formulario' => $formulario->createView()
		)
		);
	}
}
