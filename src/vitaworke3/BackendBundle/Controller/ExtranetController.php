<?php

namespace vitaworke3\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use vitaworke3\BackendBundle\Form\Extranet\ActivitatType;
use vitaworke3\ActivitatBundle\Entity\Activitat;
use vitaworke3\ActivitatBundle\Entity\Tag;
use vitaworke3\CalendariBundle\Entity\Calendari;
use vitaworke3\BackendBundle\Form\Extranet\CalendariType;
use vitaworke3\ClientBundle\Entity\Client;
use vitaworke3\ClientBundle\Entity\ClientIdioma;

use vitaworke3\BackendBundle\Form\Extranet\CalendariValorarType;
use vitaworke3\BackendBundle\Form\Extranet\TestInicialType;
use vitaworke3\BackendBundle\Form\Extranet\ClientType;
use vitaworke3\BackendBundle\Form\Extranet\ClientIdiomaType;

use vitaworke3\BackendBundle\Form\Extranet\GrupType;
use vitaworke3\BackendBundle\Form\Extranet\EmpresaType;
use vitaworke3\BackendBundle\Form\Extranet\ComiteType;
use vitaworke3\BackendBundle\Form\Extranet\FormadorType;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\SecurityContext;

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
        return $this->render('BackendBundle:Extranet:portada.html.twig');
    }

    public function ClientAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
        $paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Client'));
        $tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
		$clients = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclients($tipusclient))->getResult();
		$associats = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();	
		$associatActual='Tots';
		return $this->render('BackendBundle:Extranet:client.html.twig', array('clients' => $clients,'associats' => $associats, 'idassociat'=>$associatActual, 'paginador' => $paginador)); 
	}
   	
   	public function ClientFiltreAction($idassociat)
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Client'));
      	$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
	    $associats = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();	
	    $clients = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclientsfiltre($tipusclient,$idassociat))->getResult();
	    return $this->render('BackendBundle:Extranet:client.html.twig', array('clients' => $clients,'associats' => $associats,'idassociat'=>$idassociat,'paginador' => $paginador)); 
	}
	public function ClientNouAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        $tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
		$associats =$em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();
		$client = new Client();
        $formulario = $this->createForm(new ClientType(), $client);
        $em = $this->getDoctrine()->getEntityManager();
        if ($peticion->getMethod() == 'POST') 
        {
				$formulario->bind($peticion);
				if ($formulario->isValid()) 
				{
					$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Client'));
					$client->setTipusClient($tipusclient);
					$associatform=$peticion->request->get('associat');
					$idassociat = $em->getRepository('ClientBundle:Client')->findOneBy(array('slug' => $associatform));
					if (!empty($idassociat))
					{
						$client->setAssociat($idassociat);
					}
					$em->persist($client);
				    $em->flush();
					return $this->redirect($this->generateUrl('extranet_client'));
				}
		}
        return $this->render('BackendBundle:Extranet:clientnou.html.twig', array('idassociat'=>'','associats'=>$associats, 'accion' =>'crear','formulario' => $formulario->createView()));
    }
 	
 	public function ClientEditarAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
		$associats =$em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();
	    $client = $em->getRepository('ClientBundle:Client')->find($id);
		$IdAssociatClient=$client->getAssociat();
		if (!empty($IdAssociatClient))
		{
			$IdAssociatClient=$IdAssociatClient->getId();
		}
						
		if (!$client) {
			throw $this->createNotFoundException('client inexistent');
			}
		$formulario = $this->createForm(new ClientType(), $client);
		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) 
			{
				$associatform=$peticion->request->get('associat');
				if (!empty($associatform))
					{
						  $idassociat = $em->getRepository('ClientBundle:Client')->findOneBy(array('slug' => $associatform));
						  $associatClient=$client->getAssociat();
	     				  if ($idassociat!=$associatClient)
						  {
						  		$client->setAssociat($idassociat);
						  }
						  
					}	  	
				$em->persist($client);
				$em->flush();
				return $this->redirect($this->generateUrl('extranet_client'));
			}
		}
		return $this->render('BackendBundle:Extranet:clientnou.html.twig',array('accion' =>'editar','client' => $client,'associats'=>$associats,'idassociat'=>$IdAssociatClient,'formulario' => $formulario->createView()));
	}

    

    public function EmpresaAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
		$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		
		$empresa = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclients($tipusclient))->getResult();
		return $this->render('BackendBundle:Extranet:empresa.html.twig', array(
		'empresas' => $empresa,'paginador' => $paginador
		)); 
    }
    public function EmpresaNovaAction()
    {
        $peticion = $this->getRequest();
        $empresa = new Client();
        $formulario = $this->createForm(new EmpresaType(), $empresa);
        $em = $this->getDoctrine()->getEntityManager();
    	$idiomas =$em->getRepository('ClientBundle:Client')->queryidiomas()->getResult();
	    if ($peticion->getMethod() == 'POST') {
				$formulario->bind($peticion);
				if ($formulario->isValid()) {
					$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
					$empresa->setTipusClient($tipusclient);
					$idiomaform=$peticion->request->get('idioma');
					$ididioma = $em->getRepository('BackendBundle:Idioma')->findOneBy(array('slug' => $idiomaform));
					if (!empty($ididioma))
					{
						$empresa->setIdioma($ididioma);
					}
				
					$em->persist($empresa);
					$em->flush();
					$this->get('session')->setFlash('info',
						'Los datos de tu perfil se han actualizado correctamente'
					);
					return $this->redirect(
					$this->generateUrl('extranet_empresa')
					);
				}
			}
        
        return $this->render('BackendBundle:Extranet:empresanova.html.twig', array( 'ididioma'=>'','idiomas'=>$idiomas, 'accion' =>'crear','formulario' => $formulario->createView()));
    }
	public function EmpresaEditarAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$empresa = $em->getRepository('ClientBundle:Client')->find($id);
		$templates =$em->getRepository('ClientBundle:Client')->querytemplates($empresa)->getResult();
	    $idiomas =$em->getRepository('ClientBundle:Client')->queryidiomas()->getResult();
	    $ididioma=$empresa->getIdioma();
	    if (!empty($ididioma))
	    {
	    	$ididioma=$empresa->getIdioma()->getId();
	    }
	    
		$idtemplate=$empresa->getTemplate();
	    if (!empty($idtemplate))
	    {
	    	$idtemplate=$empresa->getTemplate()->getId();
	    }
	    
		if (!$empresa) {
			throw $this->createNotFoundException('empresa inexistent');
			}
		$formulario = $this->createForm(new EmpresaType(), $empresa);
		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$idiomaform=$peticion->request->get('idioma');
				$ididioma = $em->getRepository('BackendBundle:Idioma')->findOneBy(array('slug' => $idiomaform));
				if (!empty($ididioma))
				{
					$empresa->setIdioma($ididioma);
				}
				
				$templateform=$peticion->request->get('template');
				$idtemplate = $em->getRepository('ClientBundle:ClientIdioma')->findOneBy(array('slug' => $templateform));
				if (!empty($idtemplate))
				{
					$empresa->setTemplate($idtemplate);
				}
				$em->persist($empresa);
				$em->flush();
				return $this->redirect(
				$this->generateUrl('extranet_empresa')
				);
			}
		}
		return $this->render('BackendBundle:Extranet:empresanova.html.twig',
		array(
		'accion' =>'editar',
		'empresa' => $empresa,
		'idiomas'=>$idiomas,
		'templates'=>$templates,
		'idtemplate'=>$idtemplate,
		'ididioma'=>$ididioma,
		'formulario' => $formulario->createView()
		)
		);
	}

public function GrupAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
		
		$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		
		$associats = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();	
		$associatActual='Tots';
		
		$grup = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclients($tipusGrup))->getResult();
		return $this->render('BackendBundle:Extranet:grup.html.twig', array(
		'grups' => $grup,'paginador'=>$paginador,'associats'=>$associats,'idassociat'=>$associatActual
		)); 
    }
    
 public function GrupFiltreAction($idassociat)
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
      	$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
	    $associats = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();	
	  	$grup = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclientsfiltre($tipusGrup,$idassociat))->getResult();
		return $this->render('BackendBundle:Extranet:grup.html.twig', array(
		'grups' => $grup,'paginador'=>$paginador,'associats'=>$associats,'idassociat'=>$idassociat
		));
	   
	}


    public function GrupNouAction()
    {
        
       


        $peticion = $this->getRequest();
        $grup = new Client();
        $formulario = $this->createForm(new GrupType(), $grup);
        $em = $this->getDoctrine()->getEntityManager();
        $tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
	    $associats = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();	
	  	$idiomas =$em->getRepository('ClientBundle:Client')->queryidiomas()->getResult();
	   	if ($peticion->getMethod() == 'POST') 
	   	{
			$formulario->bind($peticion);
			if ($formulario->isValid()) 
			{
				$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
				$grup->setTipusClient($tipusclient);
				$associatform=$peticion->request->get('associat');
				$idassociat = $em->getRepository('ClientBundle:Client')->findOneBy(array('slug' => $associatform));
				if (!empty($idassociat))
				{
					$grup->setAssociat($idassociat);
				}
				$idiomaform=$peticion->request->get('idioma');
				$ididioma = $em->getRepository('BackendBundle:Idioma')->findOneBy(array('slug' => $idiomaform));
				if (!empty($ididioma))
				{
					$grup->setIdioma($ididioma);
				}
				
					
				$em->persist($grup);
				$em->flush();
				$this->get('session')->setFlash('info',
					'Los datos de tu perfil se han actualizado correctamente'
				);
				return $this->redirect(
				$this->generateUrl('extranet_grup')
				);
			}
		}
        
        return $this->render('BackendBundle:Extranet:grupnou.html.twig', array('ididioma'=>'','idassociat'=>'','idiomas'=>$idiomas,'associats'=>$associats,'accion' =>'crear','formulario' => $formulario->createView()));
    }
	public function GrupEditarAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$grup = $em->getRepository('ClientBundle:Client')->find($id);
		if (!$grup) {throw $this->createNotFoundException('grup inexistent');}
		$formulario = $this->createForm(new GrupType(), $grup);
		$templates =$em->getRepository('ClientBundle:Client')->querytemplates($grup)->getResult();
	    $idiomas =$em->getRepository('ClientBundle:Client')->queryidiomas()->getResult();
	    $ididioma=$grup->getIdioma();
	    if (!empty($ididioma))
	    {
	    	$ididioma=$grup->getIdioma()->getId();
	    }
	    
		$idtemplate=$grup->getTemplate();
	    if (!empty($idtemplate))
	    {
	    	$idtemplate=$grup->getTemplate()->getId();
	    }
	 
	    $tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
	    $idassociat=$grup->getAssociat()->getId();
	    $associats = $em->getRepository('ClientBundle:Client')->querygrupempresaeditar($tipusGrup,$tipusEmpresa,$id)->getResult();	
	  	if (!empty($idassociat))
	    {
	    	$idassociat=$grup->getAssociat()->getId();
	    }
		$peticion = $this->getRequest();
		

		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$associatform=$peticion->request->get('associat');
				$idassociat = $em->getRepository('ClientBundle:Client')->findOneBy(array('slug' => $associatform));
				if (!empty($idassociat))
				{
					$grup->setAssociat($idassociat);
				}
				$idiomaform=$peticion->request->get('idioma');
				$ididioma = $em->getRepository('BackendBundle:Idioma')->findOneBy(array('slug' => $idiomaform));
				if (!empty($ididioma))
				{
					$grup->setIdioma($ididioma);
				}
				$templateform=$peticion->request->get('idioma');
				$idtemplate = $em->getRepository('ClientBundle:ClientIdioma')->findOneBy(array('slug' => $templateform));
				if (!empty($idtemplate))
				{
					$grup->setIdioma($idtemplate);
				}
				$em->persist($grup);
				$em->flush();
				return $this->redirect(
				$this->generateUrl('extranet_grup')
				);
			}
		}
		return $this->render('BackendBundle:Extranet:grupnou.html.twig',
		array(
		'accion' =>'editar',
		'grup' => $grup,
		'idiomas'=>$idiomas,
		'templates'=>$templates,
		'idtemplate'=>$idtemplate,
		'ididioma'=>$ididioma,
		'idassociat'=>$idassociat,
		'associats'=>$associats,
		'formulario' => $formulario->createView()
		)
		);
	}

public function ComiteAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
		
        $paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);

		$comite = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclients($tipusclient))->getResult();
		return $this->render('BackendBundle:Extranet:comite.html.twig', array(
		'comites' => $comite,'paginador' => $paginador)); 
		
		
    }
    public function ComiteNouAction()
    {
        $peticion = $this->getRequest();
        $comite = new Client();
        $formulario = $this->createForm(new ComiteType(), $comite);
        $em = $this->getDoctrine()->getEntityManager();
        if ($peticion->getMethod() == 'POST') {
				$formulario->bind($peticion);
				if ($formulario->isValid()) {
					$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
					$comite->setTipusClient($tipusclient);
					$em->persist($comite);
					$em->flush();
					$this->get('session')->setFlash('info',
						'Los datos de tu perfil se han actualizado correctamente'
					);
					return $this->redirect(
					$this->generateUrl('extranet_comite')
					);
				}
			}
        
        return $this->render('BackendBundle:Extranet:comitenou.html.twig', array( 'accion' =>'crear','formulario' => $formulario->createView()));
    }
	public function ComiteEditarAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$comite = $em->getRepository('ClientBundle:Client')->find($id);
		if (!$comite) {
			throw $this->createNotFoundException('comite inexistent');
			}
		$formulario = $this->createForm(new ComiteType(), $comite);
		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$em->persist($comite);
				$em->flush();
				return $this->redirect(
				$this->generateUrl('extranet_comite')
				);
			}
		}
		return $this->render('BackendBundle:Extranet:comitenou.html.twig',
		array(
		'accion' =>'editar',
		'comite' => $comite,
		'formulario' => $formulario->createView()
		)
		);
	}
        

   	
public function FormadorAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
       	$tipusassociat = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
	    $formador = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclients($tipusclient))->getResult();
		$comites = $em->getRepository('ClientBundle:Client')->queryclients($tipusassociat)->getResult();	
		return $this->render('BackendBundle:Extranet:formador.html.twig', array('formadors' => $formador,'comites'=>$comites,'idcomite'=>'Tots','paginador'=>$paginador)); 
    }

 	

public function FormadorFiltreAction($idcomite)
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
       	$tipusassociat = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
		$formador = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclientsfiltre($tipusclient,$idcomite))->getResult();
		$comites = $em->getRepository('ClientBundle:Client')->queryclients($tipusassociat)->getResult();	
		
			return $this->render('BackendBundle:Extranet:formador.html.twig', array('formadors' => $formador,'comites' => $comites,'idcomite'=>$idcomite,'paginador' => $paginador)); 
	}

    public function FormadorNouAction()
    {
        
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        
        $tipusComite = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
		$comites =$em->getRepository('ClientBundle:Client')->queryclients($tipusComite)->getResult();
	
        $formador = new Client();
        $formulario = $this->createForm(new FormadorType(), $formador);
        if ($peticion->getMethod() == 'POST')
        {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
					$formador->setTipusClient($tipusclient);
					$comiteform=$peticion->request->get('comite');
					$idcomite = $em->getRepository('ClientBundle:Client')->findOneBy(array('slug' => $comiteform));
					if (!empty($idcomite))
					{
						$formador->setAssociat($idcomite);
					}
					$em->persist($formador);
					$em->flush();
					$this->get('session')->setFlash('info',
						'Los datos de tu perfil se han actualizado correctamente'
					);
					return $this->redirect(
					$this->generateUrl('extranet_formador')
					);
				}
			}
        
        return $this->render('BackendBundle:Extranet:formadornou.html.twig', array('idcomite'=>'', 'comites'=>$comites,'accion' =>'crear','formulario' => $formulario->createView()));
    }
	public function FormadorEditarAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$tipusComite = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
		$comites =$em->getRepository('ClientBundle:Client')->queryclients($tipusComite)->getResult();
		$formador = $em->getRepository('ClientBundle:Client')->find($id);
		$IdAssociatFormador=$formador->getAssociat()->getId();
		
		if (!$formador) {
			throw $this->createNotFoundException('formador inexistent');
			}
		$formulario = $this->createForm(new FormadorType(), $formador);
		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$comiteform=$peticion->request->get('comite');
				$idcomite = $em->getRepository('ClientBundle:Client')->findOneBy(array('slug' => $comiteform));
				if (!empty($idcomite))
				{
					$formador->setAssociat($idcomite);
				}
				$em->persist($formador);
				$em->flush();
				return $this->redirect(
				$this->generateUrl('extranet_formador')
				);
			}
		}
		return $this->render('BackendBundle:Extranet:formadornou.html.twig',
		array(
		'accion' =>'editar',
		'idcomite'=>$IdAssociatFormador, 
		'comites'=>$comites,
		'formador' => $formador,
		'formulario' => $formulario->createView()
		)
		);
	}
    
    public function CalendariAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
		$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$calendaris = $paginador->paginate(
		$em->getRepository('CalendariBundle:Calendari')->querycalendariavui()
		)->getResult();
		return $this->render('BackendBundle:Extranet:calendari.html.twig', array(
		'calendaris' => $calendaris,
		'paginador' => $paginador
		)); 


        
    }

   	public function ActivitatAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
		$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);

		$tipusformador = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
        $formadors = $em->getRepository('ClientBundle:Client')->queryclients($tipusformador)->getResult();
		$activitats = $paginador->paginate($em->getRepository('ActivitatBundle:Activitat')->queryactivitats())->getResult();
		
		return $this->render('BackendBundle:Extranet:activitat.html.twig', array(
		'activitats' => $activitats, 'formadors'=>$formadors,'idformador'=>'Tots','paginador'=>$paginador
		));   
    }
    public function ActivitatFiltreAction($idformador)
    {
    	$em = $this->getDoctrine()->getEntityManager();
       	$paginador = $this->get('ideup.simple_paginator');
       	$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);

       	$tipusformador = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
        $formadors = $em->getRepository('ClientBundle:Client')->queryclients($tipusformador)->getResult();
		$activitats = $paginador->paginate($em->getRepository('ActivitatBundle:Activitat')->queryactivitatsfiltre($idformador))->getResult();

		return $this->render('BackendBundle:Extranet:activitat.html.twig', array(
		'activitats' => $activitats, 'formadors'=>$formadors,'idformador'=>$idformador,'paginador'=>$paginador
		));   
		
	
    }
   

   	

	 public function ActivitatNovaAction()
    {
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getEntityManager();
        $activitat = new Activitat();
        $formulario = $this->createForm(new ActivitatType(), $activitat);
        $em = $this->getDoctrine()->getEntityManager();
        if ($peticion->getMethod() == 'POST') {
				$formulario->bind($peticion);
				if ($formulario->isValid()) {
					
					$em->persist($activitat);
					$em->flush();
					$this->get('session')->setFlash('info',
						'Los datos de tu perfil se han actualizado correctamente'
					);
					return $this->redirect(
					$this->generateUrl('extranet_activitat')
					);
				}
			}
        return $this->render('BackendBundle:Extranet:activitatnova.html.twig', array('accion' =>'crear','formulario' => $formulario->createView()));
    }


    public function CalendariNouAction()
    {
        $peticion = $this->getRequest();
        $calendari = new Calendari();
        $formulario = $this->createForm(new CalendariType(), $calendari);
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) 
			{
				 $em = $this->getDoctrine()->getEntityManager();
				 $enviar=$formulario->getData()->getEnviar();
				 $contenedor = $this;
				if ($enviar=='true')
				{
					$em->persist($calendari);
					$em->flush();
					$enviament = $em->getRepository('CalendariBundle:Calendari')->enviarmail($calendari,'app',$contenedor);
					$em->persist($calendari);
					$em->flush();
					$client=$calendari->getClient();
					$activitatdeldia=$calendari->getActivitat();
					$assumpte=$calendari->getassumpte();
					$titol1=$calendari->gettitol1();
					$titol2=$calendari->gettitol2();
					$nick=$calendari->getnick();
					$contingut=$calendari->getcontingut();
					$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Client'));
        			$LlistaAssociats = $em->getRepository('ClientBundle:Client')->queryclientsfiltre($tipusclient,$client)->getResult();
		
					//$LlistaAssociats = $em->getRepository('ClientBundle:Client')
					//->findBy(array('Associat' =>$client));
					foreach ($LlistaAssociats as $AssociatClient) 
					{	
						$calendariAfegit = new Calendari();
						$calendariAfegit->setClient($AssociatClient);
						$calendariAfegit->setActivitat($activitatdeldia);
						if (!empty($assumpte))
							{
								$calendariAfegit->setAssumpte($assumpte);
							}
						if (!empty($titol1))
						{
						
							$calendariAfegit->setTitol1($titol1);
						}
						if (!empty($titol2))
						{
							$calendariAfegit->setTitol2($titol2);
						}
						if (!empty($nick))
						{
							$calendariAfegit->setNick($nick);
						}
						if (!empty($contingut))
						{
							$calendariAfegit->setContingut($contingut);
						}
						$dataActivitat=new \DateTime('today');
						$calendariAfegit->setDiaActivitat($dataActivitat);
	
						$em->persist($calendariAfegit);
						$em->flush();
						$enviament = $em->getRepository('CalendariBundle:Calendari')->enviarmail($calendariAfegit,'app',$contenedor);
						$em->persist($calendariAfegit);
						$em->flush();
					}
				}
				else
				{						
					$dataActivitat=$formulario->getData()->getDiaActivitat();
					$calendari->setDiaActivitat($dataActivitat);
					$em->persist($calendari);
					$em->flush();
					
			    	
			    }
				return $this->redirect(
				$this->generateUrl('extranet_calendari')
				);
			}
		}
        return $this->render('BackendBundle:Extranet:calendarinou.html.twig', array('accion' =>'crear','formulario' => $formulario->createView()));
    }

	public function ActivitatEditarAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$activitat = $em->getRepository('ActivitatBundle:Activitat')->find($id);
		if (!$activitat) {
			throw $this->createNotFoundException('Activitat inexistent');
			}
		$formulario = $this->createForm(new ActivitatType(), $activitat);
		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$em->persist($activitat);
				$em->flush();
				return $this->redirect(
				$this->generateUrl('extranet_activitat')
				);
			}
		}
		return $this->render('BackendBundle:Extranet:activitatnova.html.twig',
		array(
		'accion' =>'editar',
		'activitat' => $activitat,
		'formulario' => $formulario->createView()
		)
		);
	}
public function CalendariActivitatVisualitzarAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$calendari = $em->getRepository('CalendariBundle:Calendari')->find($id);
		if (!$calendari) {
			throw $this->createNotFoundException('Activitat per aquest dia no assignada al calendari');
			}
		
        // em de revisar si el fet de que la valoració estigui feta, invalida el tornar a fer i valorar la activitat, per altra banda, tambe hem de veure perque
		// el diescaducitat es modifica al modificar el diacomparar.
		// ens queda tambe realitzar un template per el error invocar aquest error.html.twig en el cas que no trobi activitat assignada per aquest dia.

        $activitat=$calendari->getActivitat();
		$diescaducitat=$calendari->getDiesCaducitat();
		if (empty($diescaducitat))
		{
			$diescaducitat=$activitat->getDiesCaducitat();
		}
		$diescaducitat=$activitat->getDiesCaducitat();
		$diaactivitat=$calendari->getDiaActivitat();
		$valoracio=$calendari->getValoracio();
		$date1 = new \DateTime("now");
		$diacomparar=$diaactivitat;
		if ($diescaducitat>0)
		{
			$interval="P".$diescaducitat."D";
        	$diacomparar->add(new \DateInterval($interval));
        }	
		if (($diescaducitat>0) and ($date1>$diacomparar))
		{	
			return $this->render('BackendBundle:Extranet:error.html.twig',array('diaactivitat'=>$diaactivitat,'ara'=>$date1,'diainterval'=>$diacomparar,'valoracio'=>$valoracio));
		}else
        {
			$peticion = $this->getRequest();
			$tipologia=$activitat->getTipologia();
			if ($tipologia == 'Tipologia 99')
			{
				$formulario=$this->createForm(new TestInicialType(),$calendari);
				if ($peticion->getMethod() == 'POST') 
				{
					$formulario->bind($peticion);
					$valorada = new \DateTime("now");
					$calendari->setValorada($valorada);	
					$em->persist($calendari);
					$em->flush();
					return $this->render('BackendBundle:Extranet:valorattestinicial.html.twig',array('formulario' => $formulario->createView()));
					
				}

				$oberta = new \DateTime("now");
				$calendari->setOberta($oberta);	
				return $this->render('BackendBundle:Extranet:testinicial.html.twig',
				array(
				'calendari'=>$calendari,
				'activitat' => $activitat,
				'formulario' => $formulario->createView()
				));

			}else
			{
				$formulario = $this->createForm(new CalendariValorarType());
				if ($peticion->getMethod() == 'POST') 
				{
					//$formulario->bind($peticion);
					//$valoracio = $formulario->getData()->getValoracio();
					//$calendari->setValoracio($valoracio);
					
					//$valorada=new \DateTime('now');
					//$calendari->setValorada($valorada);	
					//$em->persist($calendari);
					//$em->flush();
					//return $this->render('BackendBundle:Extranet:valorat.html.twig',array( 'calendari'=>$calendari,'formulario' => $formulario->createView()));
					$id=$calendari->getId();
					return $this->render('BackendBundle:Extranet:activitatvisualitzar.html.twig',
				array(
				'calendari'=>$calendari,
				'activitat' => $activitat,
				'formulario' => $formulario->createView()
					));
					
				}
			

				$oberta=new \DateTime('now');
				$calendari->setOberta($oberta);	
				$em->persist($calendari);
				$em->flush();
				$camp1=$activitat->getTipusCamp1();
				$camp2=$activitat->getTipusCamp2();
				$camp3=$activitat->getTipusCamp3();
				$camp4=$activitat->getTipusCamp4();
				$camp5=$activitat->getTipusCamp5();
				$camp6=$activitat->getTipusCamp6();
				$camp7=$activitat->getTipusCamp7();
				$camp8=$activitat->getTipusCamp8();
				$class1='text_left';
				$class2='text_right';
				$class3='text_left';
				$class4='text_right';
				$class5='text_left';
				$class6='text_right';
				$class7='text_left';
				$class8='text_right';
				$align1='';
				$align2='';
				$align3='';
				$align4='';
				$align5='';
				$align6='';
				$align7='';
				$align8='';
	
				if (empty($camp1) or empty($camp2))
				{
					$class1='text';
					$class2='text';
					$align1='center';
					$align2='center';
				}
				if (empty($camp3) or empty($camp4))
				{
					$class3='text';
					$class4='text';
					$align3='center';
					$align4='center';
				}
				if (empty($camp5) or empty($camp6))
				{
					$class5='text';
					$class6='text';
					$align5='center';
					$align6='center';
				}
				if (empty($camp7) or empty($camp8))
				{
					$class7='text';
					$class8='text';
					$align7='center';
					$align8='center';
				}
				
				return $this->render('BackendBundle:Extranet:activitatvisualitzar.html.twig',
				array(
				'calendari'=>$calendari,
				'activitat' => $activitat,
				'class1'=>$class1,'align1'=>$align1,
				'class2'=>$class2,'align2'=>$align2,
				'class3'=>$class3,'align3'=>$align3,
				'class4'=>$class4,'align4'=>$align4,
				'class5'=>$class5,'align5'=>$align5,
				'class6'=>$class6,'align6'=>$align6,
				'class7'=>$class7,'align7'=>$align7,
				'class8'=>$class8,'align8'=>$align8,
	
				'formulario' => $formulario->createView()
				));
	
			}
			
			
		}
	}

public function CalendariValorarAction($id)
{
	    $em = $this->getDoctrine()->getEntityManager();
		$calendari = $em->getRepository('CalendariBundle:Calendari')->find($id);
		$formulario = $this->createForm(new CalendariValorarType());
		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') 
		{
			$formulario->bind($peticion);
			$star1=$peticion->request->get('btn_mala');
			$star2=$peticion->request->get('btn_regular');
			$star3=$peticion->request->get('btn_buena');
			$star4=$peticion->request->get('btn_muybuena');
			$star5=$peticion->request->get('btn_excelente');
			if (!empty($star1)){$valoracio=1;}
			if (!empty($star2)){$valoracio=2;}
			if (!empty($star3)){$valoracio=3;}
			if (!empty($star4)){$valoracio=4;}
			if (!empty($star5)){$valoracio=5;}
			$form = $formulario->getData();
			$calendari->setValoracio($valoracio);
			$valorada=new \DateTime('now');
			$calendari->setValorada($valorada);	
			$em->persist($calendari);
			$em->flush();
		}
		return $this->render('BackendBundle:Extranet:valorat.html.twig',array('calendari'=>$calendari, 'formulario' => $formulario->createView()));

}
public function CalendariEditarAction($id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$calendari = $em->getRepository('CalendariBundle:Calendari')->find($id);
		if (!$calendari) {
			throw $this->createNotFoundException('Calendari inexistent');
			}
		$peticion = $this->getRequest();
		$formulario = $this->createForm(new CalendariType(), $calendari);
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
			    
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($calendari);
				$em->flush();
				return $this->redirect(
				$this->generateUrl('extranet_calendari')
				);
				}
			}
		
		return $this->render('BackendBundle:Extranet:calendarinou.html.twig',
		array(
		'accion' =>'editar',
		'calendari' => $calendari,
		'formulario' => $formulario->createView()
		)
		);
	}

public function CalendariEmailAction($id)
	{

 		$em = $this->getDoctrine()->getEntityManager();
		$calendari = $em->getRepository('CalendariBundle:Calendari')->find($id);
		$host ='http://vitawork.vitaworke3.com' ;
		$activitat=$calendari->getActivitat();
		$client=$calendari->getClient();
		$nomClient=$client->getNom();
		$host ='http://vitawork.vitaworke3.com' ;
		return $this->render('BackendBundle:Activitat:email.html.twig',
		array(
		'usuari' => $client,'activitat'=>$activitat,'host'=>$host,'calendari'=>$calendari
		,'accio' =>'editar')
		);
		
	}			

public function PreviewAction($id)
	{

 		$em = $this->getDoctrine()->getEntityManager();
		$activitat = $em->getRepository('ActivitatBundle:Activitat')->find($id);
		$camp1=$activitat->getTipusCamp1();
		$camp2=$activitat->getTipusCamp2();
		$camp3=$activitat->getTipusCamp3();
		$camp4=$activitat->getTipusCamp4();
		$camp5=$activitat->getTipusCamp5();
		$camp6=$activitat->getTipusCamp6();
		$camp7=$activitat->getTipusCamp7();
		$camp8=$activitat->getTipusCamp8();
		

		$class1='text_left';
		$class2='text_right';
		$class3='text_left';
		$class4='text_right';
		$class5='text_left';
		$class6='text_right';
		$class7='text_left';
		$class8='text_right';
		
		$align1='';
		$align2='';
		$align3='';
		$align4='';
		$align5='';
		$align6='';
		$align7='';
		$align8='';
	
		if (empty($camp1) or empty($camp2))
		{
			$class1='text';
			$class2='text';
			$align1='center';
			$align2='center';
		}
		if (empty($camp3) or empty($camp4))
		{
			$class3='text';
			$class4='text';
			$align3='center';
			$align4='center';
		}
		if (empty($camp5) or empty($camp6))
		{
			$class5='text';
			$class6='text';
			$align5='center';
			$align6='center';
		}
		if (empty($camp7) or empty($camp8))
		{
			$class7='text';
			$class8='text';
			$align7='center';
			$align8='center';
		}
		$host ='http://vitawork.vitaworke3.com' ;
		return $this->render('BackendBundle:Extranet:preview.html.twig',
		array('host'=>$host,'activitat'=>$activitat, 
			'class1'=>$class1,'align1'=>$align1,
			'class2'=>$class2,'align2'=>$align2,
			'class3'=>$class3,'align3'=>$align3,
			'class4'=>$class4,'align4'=>$align4,
			'class5'=>$class5,'align5'=>$align5,
			'class6'=>$class6,'align6'=>$align6,
			'class7'=>$class7,'align7'=>$align7,
			'class8'=>$class8,'align8'=>$align8,
			));
		
	}		


	public function PerfilAction()
    {
        return $this->render('BackendBundle:Extranet:perfil.html.twig');
    }


public function ClientIdiomaAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$empreses = $em->getRepository('ClientBundle:ClientIdioma')->findAll();
       	//$grup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
	    //$empreses = $em->getRepository('ClientBundle:Client')->findBy(array('TipusClient' => $empresa));	
		//$grups = $em->getRepository('ClientBundle:Client')->findBy(array('TipusClient' => $grup));

			return $this->render('BackendBundle:Extranet:clientidioma.html.twig', array('empreses' => $empreses,'idempresa'=>'Tots')); 
    }
    public function ClientIdiomaFiltreAction($idempresa)
    {
       	$em = $this->getDoctrine()->getEntityManager();
       	$empreses = $em->getRepository('ClientBundle:ClientIdioma')->findAll();
       
			return $this->render('BackendBundle:Extranet:clientidioma.html.twig', array('empreses' => $empreses,'idempresa'=>$idempresa)); 
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
        
        return $this->render('BackendBundle:Extranet:clientidiomanou.html.twig', array( 'accion' =>'crear','formulario' => $formulario->createView()));
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
		return $this->render('BackendBundle:Extranet:clientidiomanou.html.twig',
		array(
		'accion' =>'editar',
		'clientidioma' => $clientidioma,
		'formulario' => $formulario->createView()
		)
		);
	}


}

