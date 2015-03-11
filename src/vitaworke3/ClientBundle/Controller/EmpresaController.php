<?php

namespace vitaworke3\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use vitaworke3\ClientBundle\Entity\Client;
use vitaworke3\ClientBundle\Form\EmpresaType;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\SecurityContext;

class EmpresaController extends Controller
{

	    public function EmpresaAction()
    {
       	$em = $this->getDoctrine()->getManager();
       	$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
       	$idiomas =$em->getRepository('ClientBundle:Client')->queryidiomas()->getResult();
    	$tipusComite = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
		$tipusFormador = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
	    $responsables = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusComite,$tipusFormador)->getResult();	
		$templates =$em->getRepository('ClientBundle:Client')->querytemplatesall()->getResult();
		$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$empresa = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclients($tipusclient))->getResult();
		return $this->render('ClientBundle:Empresa:empresa.html.twig', array(
		'empresas' => $empresa,
		'idiomas'=>$idiomas,
		'ididioma'=>'0',
		'templates'=>$templates,
		'idtemplate'=>'0',
		'responsables'=>$responsables,
		'idresponsable'=>'0',
		'paginador' => $paginador
		)); 
    }

    public function EmpresaFiltreAction($ididioma,$idtemplate,$idresponsable)
    {
        $em = $this->getDoctrine()->getManager();
       	$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
       	$idiomas =$em->getRepository('ClientBundle:Client')->queryidiomas()->getResult();
       	$templates =$em->getRepository('ClientBundle:Client')->querytemplatesall()->getResult();
    	$tipusComite = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
		$tipusFormador = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
	    $responsables = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusComite,$tipusFormador)->getResult();	
 		$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$empresa = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclientsfiltre($tipusclient,'',$ididioma,$idtemplate,$idresponsable))->getResult();
		return $this->render('ClientBundle:Empresa:empresa.html.twig', array(
		'empresas' => $empresa,
		'idiomas'=>$idiomas,
		'ididioma'=>$ididioma,
		'templates'=>$templates,
		'idtemplate'=>$idtemplate,
		'responsables'=>$responsables,
		'idresponsable'=>$idresponsable,
		'paginador' => $paginador
		));  
	}
    public function EmpresaNovaAction()
    {
        $peticion = $this->getRequest();
        $empresa = new Client();
        $formulario = $this->createForm(new EmpresaType(), $empresa);
        $em = $this->getDoctrine()->getManager();
    	if ($peticion->getMethod() == 'POST') {
				$formulario->bind($peticion);
				if ($formulario->isValid()) {
					$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
					$empresa->setTipusClient($tipusclient);
					$em->persist($empresa);
					$em->flush();
					$id=$empresa->getId();
					$MyId = $this->get('nzo_url_encryptor')->encrypt($id);
					return $this->redirect($this->generateUrl('extranet_empresa_editar',  array( 'id'=> $MyId)));
				}
			}
        return $this->render('ClientBundle:Empresa:empresanova.html.twig', array('accion' =>'crear','formulario' => $formulario->createView()));
    }
	public function EmpresaEditarAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$empresa = $em->getRepository('ClientBundle:Client')->find($id);
	 	if (!$empresa) {
	 		$MyId = $this->get('nzo_url_encryptor')->decrypt($id);
			$empresa = $em->getRepository('ClientBundle:Client')->find($MyId);
			if (!$empresa) {
	 			throw $this->createNotFoundException('empresa inexistent');
			}
		}
		$formulario = $this->createForm(new EmpresaType(), $empresa);
	    $peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$em->persist($empresa);
				$em->flush();
				$id=$empresa->getId();
				$MyId = $this->get('nzo_url_encryptor')->encrypt($id);
				return $this->redirect($this->generateUrl('extranet_empresa_editar',  array( 'id'=> $MyId)));
			}
		}
		return $this->render('ClientBundle:Empresa:empresanova.html.twig',
		array(
		'accion' =>'editar',
		'empresa' => $empresa,
		'formulario' => $formulario->createView()
		)
		);
	}

}