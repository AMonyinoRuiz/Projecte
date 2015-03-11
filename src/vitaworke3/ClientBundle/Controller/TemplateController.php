<?php

namespace vitaworke3\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use vitaworke3\ClientBundle\Entity\Client;
use vitaworke3\ClientBundle\Entity\Template;
use vitaworke3\ClientBundle\Form\TemplateType;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\SecurityContext;

class TemplateController extends Controller
{
	public function TemplateAction()
    {
       	$em = $this->getDoctrine()->getManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
	    $associats = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();
       	$idiomas =$em->getRepository('ClientBundle:Client')->queryidiomas()->getResult();
    	$templates = $paginador->paginate($em->getRepository('ClientBundle:Client')->queryclientidioma())->getResult();  
     	return $this->render('ClientBundle:Template:template.html.twig', array(
     		'templates' => $templates,
     		'associats'=>$associats,
     		'idassociat'=>'0',
     		'idiomas'=>$idiomas,
			'ididioma'=>'0',
     		'paginador' => $paginador)); 
    }
    public function TemplateFiltreAction($idassociat,$ididioma)
    {
       	$em = $this->getDoctrine()->getManager();
       	$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
	    $associats = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();
       	$idiomas =$em->getRepository('ClientBundle:Client')->queryidiomas()->getResult();
   		$templates = $paginador->paginate($em->getRepository('ClientBundle:Client')->querytemplatesfiltre($idassociat,$ididioma))->getResult();
	   	return $this->render('ClientBundle:Template:template.html.twig', array(
       		'templates' => $templates,
     		'associats'=>$associats,
     		'idassociat'=>$idassociat,
     		'idiomas'=>$idiomas,
			'ididioma'=>$ididioma,
     		'paginador' => $paginador));  
	}

    public function TemplateNouAction()
    {
        $em = $this->getDoctrine()->getManager();
        $peticion = $this->getRequest();
        $template = new Template();
        $formulario = $this->createForm(new TemplateType(), $template);
        if ($peticion->getMethod() == 'POST')
        {
			$formulario->bind($peticion);
			if ($formulario->isValid()) 
			{
				$em->persist($template);
				$em->flush();
				$id=$template->getId();
				return $this->redirect($this->generateUrl('extranet_template_editar',  array( 'id'=> $id)));
			}
		}
        return $this->render('ClientBundle:Template:templatenou2.html.twig', array( 'accion' =>'crear','formulario' => $formulario->createView()));
    }
	public function TemplateEditarAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$template = $em->getRepository('ClientBundle:Template')->find($id);
		if (!$template) {
			throw $this->createNotFoundException('No hi ha template idioma per aquest/a Grup/Empresa');
			}
		$formulario = $this->createForm(new TemplateType(), $template);
		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$em->persist($template);
				$em->flush();
				return $this->redirect($this->generateUrl('extranet_template_editar',  array( 'id'=> $id)));
			}
		}
		return $this->render('ClientBundle:Template:templatenou2.html.twig',
		array(
		'accion' =>'editar',
		'template' => $template,
		'formulario' => $formulario->createView()
		)
		);
	}
}