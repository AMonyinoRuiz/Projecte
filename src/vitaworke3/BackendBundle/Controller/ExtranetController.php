<?php

namespace vitaworke3\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use vitaworke3\BackendBundle\Form\Extranet\ActivitatType;
use vitaworke3\ActivitatBundle\Entity\Activitat;
use vitaworke3\ActivitatBundle\Entity\Tag;
use vitaworke3\CalendariBundle\Entity\Calendari;
use vitaworke3\CalendariBundle\Entity\Planning;
use vitaworke3\UsuarisBundle\Entity\Usuari;

use vitaworke3\BackendBundle\Form\Extranet\CalendariType;
use vitaworke3\ClientBundle\Entity\Client;
use vitaworke3\ClientBundle\Entity\ClientIdioma;
use vitaworke3\BackendBundle\Form\Extranet\CalendariValorarType;
use vitaworke3\BackendBundle\Form\Extranet\PlanningNouType;

use vitaworke3\BackendBundle\Form\Extranet\TestInicialType;
use vitaworke3\BackendBundle\Form\Extranet\ClientType;
use vitaworke3\BackendBundle\Form\Extranet\ClientIdiomaType;
use vitaworke3\BackendBundle\Form\Extranet\GrupType;
use vitaworke3\BackendBundle\Form\Extranet\EmpresaType;
use vitaworke3\BackendBundle\Form\Extranet\ComiteType;
use vitaworke3\BackendBundle\Form\Extranet\FormadorType;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\SecurityContext;
use vitaworke3\UsuarisBundle\Form\RegistrationFormType;

class ExtranetController extends Controller
{
    
   public function loginAction()
	{
		$peticion = $this->getRequest();
		$sesion = $peticion->getSession();
		$error = $peticion->attributes->get(
			SecurityContext::AUTHENTICATION_ERROR,
			$sesion->get(SecurityContext::AUTHENTICATION_ERROR)
			);
		return $this->render('BackendBundle:Extranet:login.html.twig', array(
		'error' => $error
		));
	}

	public function iniciAction()
    {
        return $this->render('BackendBundle:Extranet:inici.html.twig');
    }
	public function portadaAction()
	{
       	$user = $this->container->get('security.context')->getToken()->getUser();
    	$rols=$user->getRoles();
		$rolAdmin=0;
		foreach ($rols as $rol)
		 {
			if ($rol=='ROLE_ADMIN')
			{	
				$rolAdmin=1;
			}
		 }
	
        return $this->render('BackendBundle:Extranet:frontend.html.twig', array('rol' => $rolAdmin));
    }

   
    




	public function PerfilAction()
    {
        return $this->render('BackendBundle:Extranet:perfil.html.twig');
    }




public function UsuarisAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);

       	 $usuaris =  $paginador->paginate($em->getRepository('UsuarisBundle:Usuari')->queryusuaris())->getResult();
       	
       	
			return $this->render('BackendBundle:Extranet:usuaris.html.twig', array('usuaris' => $usuaris,'paginador'=>$paginador)); 
    }



 public function UsuarisNouAction()
    {
        $peticion = $this->getRequest();
      
        $formulario = $this->createForm(new RegistrationFormType());
        $em = $this->getDoctrine()->getEntityManager();
        if ($peticion->getMethod() == 'POST') {
				$formulario->bind($peticion);
				if ($formulario->isValid()) {
					$em->persist($usuari);
					$em->flush();
					$this->get('session')->setFlash('info',
						'Los datos de tu perfil se han actualizado correctamente'
					);
					return $this->redirect(
					$this->generateUrl('extranet_usuaris')
					);
				}
			}
        
        return $this->render('BackendBundle:Extranet:usuarinou.html.twig', array( 'accion' =>'crear','formulario' => $formulario->createView()));
    }
}