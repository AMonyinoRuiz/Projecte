<?php

namespace vitaworke3\ClientBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use vitaworke3\ClientBundle\Entity\Client;
use vitaworke3\ClientBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\SecurityContext;

class ClientController extends Controller
{
    public function ClientAction()
    {
       	$em = $this->getDoctrine()->getManager();
        $paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Client'));
        $tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
		$clients = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclients($tipusclient))->getResult();
		$associats = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();	
		$associatActual='0';
		return $this->render('ClientBundle:Client:client.html.twig', array('clients' => $clients,'associats' => $associats, 'idassociat'=>$associatActual, 'paginador' => $paginador)); 
	}
   	
   	public function ClientFiltreAction($idassociat)
    {
       	$em = $this->getDoctrine()->getManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Client'));
      	$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
	    $associats = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();	
	    $clients = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclientsfiltre($tipusclient,$idassociat,'','',''))->getResult();
	    return $this->render('ClientBundle:Client:client.html.twig', array('clients' => $clients,'associats' => $associats,'idassociat'=>$idassociat,'paginador' => $paginador)); 
	}
	public function ClientNouAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
		$associats =$em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();
		$client = new Client();
        $formulario = $this->createForm(new ClientType(), $client);
        if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Client'));
				$client->setTipusClient($tipusclient);
				$em->persist($client);
			    $em->flush();
			    $id=$client->getId();
			    $MyId = $this->get('nzo_url_encryptor')->encrypt($id);
				return $this->redirect($this->generateUrl('extranet_client_editar',  array( 'id'=>  $MyId)));
			}
		}
        return $this->render('ClientBundle:Client:clientnou.html.twig', array('accion' =>'crear','formulario' => $formulario->createView()));
    }
 	
 	public function ClientEditarAction($id)
	{
		$peticion = $this->getRequest();
		$em = $this->getDoctrine()->getManager();
	    $client = $em->getRepository('ClientBundle:Client')->find($id);
		if (!$client) {
			$MyId = $this->get('nzo_url_encryptor')->decrypt($id);
			$client = $em->getRepository('ClientBundle:Client')->find($MyId);
			if (!$client) {
				throw $this->createNotFoundException('client inexistent');
			}
		}
		$formulario = $this->createForm(new ClientType(), $client);
		if ($peticion->getMethod() == 'POST'){
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$em->persist($client);
				$em->flush();
				$MyId = $this->get('nzo_url_encryptor')->encrypt($id);
				return $this->redirect($this->generateUrl('extranet_client_editar',  array( 'id'=> $MyId)));
			}
		}
		return $this->render('ClientBundle:Client:clientnou.html.twig',array('accion' =>'editar','client' => $client,'formulario' => $formulario->createView()));
	}


}