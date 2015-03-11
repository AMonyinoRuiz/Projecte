<?php

namespace vitaworke3\UsuarisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use vitaworke3\UsuarisBundle\Entity\Usuari;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\Security;
use vitaworke3\UsuarisBundle\Form\RegistrationFormType;
use vitaworke3\UsuarisBundle\Form\EditFormType;



class UsuarisController extends Controller
{


public function UsuarisAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$usuaris =  $paginador->paginate($em->getRepository('UsuarisBundle:Usuari')->queryusuaris())->getResult();
       		
       		return $this->render('UsuarisBundle:Usuaris:usuaris.html.twig', array('usuaris' => $usuaris,'paginador'=>$paginador)); 
    }



 public function UsuarisNouAction()
    {
        $peticion = $this->getRequest();
        $usuari = new Usuari();
      	$formulario = $this->createForm(new RegistrationFormType(),$usuari);
        $em = $this->getDoctrine()->getEntityManager();
        if ($peticion->getMethod() == 'POST') {
				$formulario->bind($peticion);
				if ($formulario->isValid()) 
				{
					$rolAdmin=$peticion->request->get('Administrador');
			    	$rolUser=$peticion->request->get('Usuari');
					$rolUser=1;
					if ($rolAdmin==1)
					{
						$usuari->addRole('ROLE_ADMIN');
					
					}else
					{
						$usuari->removeRole('ROLE_ADMIN');
					
					}
					if ($rolUser==1)
					{
						$usuari->addRole('ROLE_USER');
				
					}else
					{
						$usuari->removeRole('ROLE_USER');
				
					}
				
			
					$em->persist($usuari);
					$em->flush();
					$id=$usuari->getId();
					return $this->redirect($this->generateUrl('extranet_usuaris_editar',  array( 'id'=> $id)));
				}
			}
      

        return $this->render('UsuarisBundle:Usuaris:usuarinou.html.twig', array( 'usuari'=>$usuari,'accion' =>'crear','formulario' => $formulario->createView()));
    }

   public function UsuarisEditarAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$usuari = $em->getRepository('UsuarisBundle:Usuari')->find($id);

		if (!$usuari) {
			throw $this->createNotFoundException('Usuari inexistent');
			}
		$peticion = $this->getRequest();
		$formulario = $this->createForm(new RegistrationFormType(),$usuari);
        if ($peticion->getMethod() == 'POST') {
        	$formulario->bind($peticion);
			if ($formulario->isValid()) {
			    $rolAdmin=$peticion->request->get('Administrador');
			    $rolUser=$peticion->request->get('Usuari');
				$rolUser=1;
				if ($rolAdmin==1)
				{
					$usuari->addRole('ROLE_ADMIN');
				
				}else
				{
					$usuari->removeRole('ROLE_ADMIN');
				
				}
				if ($rolUser==1)
				{
					$usuari->addRole('ROLE_USER');
				
				}else
				{
					$usuari->removeRole('ROLE_USER');
				
				}
				
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($usuari);
				$em->flush();
				return $this->redirect($this->generateUrl('extranet_usuaris_editar',  array( 'id'=> $id)));
				}
			}
		
		return $this->render('UsuarisBundle:Usuaris:usuarinou.html.twig',
		array(
		'accion' =>'editar',
		'usuari' => $usuari,
		'formulario' => $formulario->createView()
		)
		);
	}

	public function UsuarisResetAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$usuari = $em->getRepository('UsuarisBundle:Usuari')->find($id);
		if (!$usuari) {
			throw $this->createNotFoundException('Usuari inexistent');
			}
		$peticion = $this->getRequest();
		$formulario = $this->createForm(new RegistrationFormType(),$usuari);
        if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$usuari->setPassword('12345');
			    $em = $this->getDoctrine()->getEntityManager();
				$em->persist($usuari);
				$em->flush();
				return $this->redirect($this->generateUrl('extranet_usuaris_reset',  array( 'id'=> $id)));
				}
			}
		
		return $this->render('UsuarisBundle:Usuaris:usuarinou.html.twig',
		array(
		'accion' =>'reset',
		'usuari' => $usuari,
		'formulario' => $formulario->createView()
		)
		);
	}
}