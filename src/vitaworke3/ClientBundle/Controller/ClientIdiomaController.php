<?php

namespace vitaworke3\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use vitaworke3\ClientBundle\Entity\Client;
use vitaworke3\ClientBundle\Entity\ClientIdioma;

use vitaworke3\ClientBundle\Form\ClientIdiomaType;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\SecurityContext;

class ClientIdiomaController extends Controller
{
	public function ClientIdiomaAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$empreses = $em->getRepository('ClientBundle:ClientIdioma')->findAll();
       	//$grup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
	    //$empreses = $em->getRepository('ClientBundle:Client')->findBy(array('TipusClient' => $empresa));	
		//$grups = $em->getRepository('ClientBundle:Client')->findBy(array('TipusClient' => $grup));

			return $this->render('ClientBundle:ClientIdioma:clientidioma.html.twig', array('empreses' => $empreses,'idempresa'=>'Tots')); 
    }
    public function ClientIdiomaFiltreAction($idempresa)
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$empreses = $em->getRepository('ClientBundle:ClientIdioma')->findAll();
       
			return $this->render('ClientBundle:ClientIdioma:clientidioma.html.twig', array('empreses' => $empreses,'idempresa'=>$idempresa)); 
	}

    public function ClientIdiomaNouAction()
    {
        $peticion = $this->getRequest();
        $ClientIdioma = new ClientIdioma();
        $formulario = $this->createForm(new ClientIdiomaType(), $ClientIdioma);
        $em = $this->getDoctrine()->getEntityManager();
        if ($peticion->getMethod() == 'POST') {
				$formulario->bind($peticion);
				if ($formulario->isValid()) {
					$em->persist($ClientIdioma);
					$em->flush();
					return $this->redirect(
					$this->generateUrl('extranet_client_idioma')
					);
				}
			}
        
        return $this->render('ClientBundle:ClientIdioma:clientidiomanou.html.twig', array( 'accion' =>'crear','formulario' => $formulario->createView()));
    }
	public function ClientIdiomaEditarAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$clientidioma = $em->getRepository('ClientBundle:ClientIdioma')->find($id);
		if (!$clientidioma) {
			throw $this->createNotFoundException('No hi ha template idioma per aquest/a Grup/Empresa');
			}
		$formulario = $this->createForm(new ClientIdiomaType(), $clientidioma);
		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$em->persist($clientidioma);
				$em->flush();
				return $this->redirect(
				$this->generateUrl('extranet_client_idioma')
				);
			}
		}
		return $this->render('ClientBundle:ClientIdioma:clientidiomanou.html.twig',
		array(
		'accion' =>'editar',
		'clientidioma' => $clientidioma,
		'formulario' => $formulario->createView()
		)
		);
	}
}