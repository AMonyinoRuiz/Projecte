<?php

namespace vitaworke3\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use vitaworke3\ClientBundle\Entity\Client;
use vitaworke3\ClientBundle\Form\FormadorType;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\SecurityContext;

class FormadorController extends Controller
{

	public function FormadorAction()
    {
       	$em = $this->getDoctrine()->getManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
       	$tipusassociat = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
	    $formador = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclients($tipusclient))->getResult();
		$comites = $em->getRepository('ClientBundle:Client')->queryclients($tipusassociat)->getResult();	
		return $this->render('ClientBundle:Formador:formador.html.twig', array('formadors' => $formador,'comites'=>$comites,'idcomite'=>'Tots','paginador'=>$paginador)); 
    }
	
	public function FormadorFiltreAction($idcomite)
    {
       	$em = $this->getDoctrine()->getManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
       	$tipusassociat = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
		$formador = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclientsfiltre($tipusclient,$idcomite))->getResult();
		$comites = $em->getRepository('ClientBundle:Client')->queryclients($tipusassociat)->getResult();	
		return $this->render('ClientBundle:Formador:formador.html.twig', array('formadors' => $formador,'comites' => $comites,'idcomite'=>$idcomite,'paginador' => $paginador)); 
	}

    public function FormadorNouAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $formador = new Client();
        $formulario = $this->createForm(new FormadorType(), $formador);
        if ($peticion->getMethod() == 'POST')
        {
            $formulario->bind($peticion);
	    	if ($formulario->isValid()) {
                $tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
				$formador->setTipusClient($tipusclient);
				$em->persist($formador);
				$em->flush();
				$id=$formador->getId();
				$MyId = $this->get('nzo_url_encryptor')->encrypt($id);
				return $this->redirect($this->generateUrl('extranet_formador_editar',  array( 'id'=> $MyId)));
        	}
        }
        return $this->render('ClientBundle:Formador:formadornou.html.twig', array('accion' =>'crear','formulario' => $formulario->createView()));
    }
	public function FormadorEditarAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$formador = $em->getRepository('ClientBundle:Client')->find($id);
		if (!$formador) {
			$MyId = $this->get('nzo_url_encryptor')->decrypt($id);
			$formador = $em->getRepository('ClientBundle:Client')->find($MyId);
			if (!$formador) {
				throw $this->createNotFoundException('formador inexistent');
				}
		}
		$formulario = $this->createForm(new FormadorType(), $formador);
		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$em->persist($formador);
				$em->flush();
				$id=$formador->getId();
				$MyId = $this->get('nzo_url_encryptor')->encrypt($id);
				return $this->redirect($this->generateUrl('extranet_formador_editar',  array( 'id'=> $MyId)));
			}
		}
		return $this->render('ClientBundle:Formador:formadornou.html.twig',
		array(
		'accion' =>'editar',
		'formador' => $formador,
		'formulario' => $formulario->createView()
		)
		);
	}
}