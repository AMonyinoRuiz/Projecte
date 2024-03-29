<?php

namespace vitaworke3\ActivitatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use vitaworke3\ActivitatBundle\Form\ActivitatType;
use vitaworke3\ActivitatBundle\Entity\Activitat;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\SecurityContext;

class ActivitatController extends Controller
{
  public function ActivitatAction(){
    $em = $this->getDoctrine()->getManager();
	$paginador = $this->get('ideup.simple_paginator');
	$paginador->setItemsPerPage(20);
	$paginador->setMaxPagerItems(5);
	$tipusformador = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
    $formadors = $em->getRepository('ClientBundle:Client')->queryclients($tipusformador)->getResult();
    $tipusComite = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
	$comites =$em->getRepository('ClientBundle:Client')->queryclients($tipusComite)->getResult();
	$tipologies =$em->getRepository('ActivitatBundle:Activitat')->querytipologies()->getResult();
	$formats =$em->getRepository('ActivitatBundle:Activitat')->queryformats()->getResult();
	$user = $this->container->get('security.context')->getToken()->getUser();
    $mail=$user->getEmail();
	$rols=$user->getRoles();
	$responsable = $em->getRepository('ClientBundle:Client')->findOneBy(array('Mail' =>$mail, 'TipusClient' => $tipusformador));
	$Associats='0'; //$responsable->getAssociat();
	$AdminCapProjecte=$this->EsAdminCapProjecte($rols,$responsable,$Associats);
	$rolAdmin=$AdminCapProjecte;
	$activitats = $this->CercaActivitatAction($AdminCapProjecte,$responsable,$Associats);
	return $this->render('ActivitatBundle:Activitat:activitat.html.twig', array(
	'activitats' => $activitats, 
	'formadors'=>$formadors,
	'idformador'=>'0',
	'comites'=>$comites,
	'idcomite'=>'0',
	'tipologies'=>$tipologies,
	'idtipologia'=>'0',
	'formats'=>$formats,
	'idformat'=>'0',
	'associats'=>$Associats,
	'responsable'=>$responsable,
	'paginador'=>$paginador
	));   
    }

    public function ActivitatFiltreAction($idformador,$idcomite,$idtipologia,$idformat)
    {
    	$em = $this->getDoctrine()->getManager();
       	$paginador = $this->get('ideup.simple_paginator');
       	$paginador->setItemsPerPage(20);
	    $paginador->setMaxPagerItems(5);
        $tipusformador = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
        $formadors = $em->getRepository('ClientBundle:Client')->queryclients($tipusformador)->getResult();
        $tipusComite = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Comite'));
	    $comites =$em->getRepository('ClientBundle:Client')->queryclients($tipusComite)->getResult();
	    $tipologies =$em->getRepository('ActivitatBundle:Activitat')->querytipologies()->getResult();
	    $formats =$em->getRepository('ActivitatBundle:Activitat')->queryformats()->getResult();
	   	$activitats = $paginador->paginate($em->getRepository('ActivitatBundle:Activitat')->queryactivitatsfiltre($idformador,$idcomite,$idtipologia,$idformat))->getResult();
		return $this->render('ActivitatBundle:Activitat:activitat.html.twig', array(
		'activitats' => $activitats, 
		'formadors'=>$formadors,
		'idformador'=>$idformador,
		'comites'=>$comites,
		'idcomite'=>$idcomite,
		'tipologies'=>$tipologies,
		'idtipologia'=>$idtipologia,
		'formats'=>$formats,
		'idformat'=>$idformat,
		'paginador'=>$paginador
		));   
    }
   	
   	public function ActivitatNovaAction()
    {
        $em = $this->getDoctrine()->getManager();
	    $user = $this->container->get('security.context')->getToken()->getUser();
    	$mail=$user->getEmail();
		$rols=$user->getRoles();
		$tipusformador = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
		$responsable = $em->getRepository('ClientBundle:Client')->findOneBy(array('Mail' =>$mail, 'TipusClient' => $tipusformador));
	
		$Associats='0'; //$responsable->getAssociat();
		$AdminCapProjecte=$this->EsAdminCapProjecte($rols,$responsable,$Associats);
		$rolAdmin=$AdminCapProjecte;
        $peticion = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $activitat = new Activitat();
        $formulario = $this->createForm(new ActivitatType(), $activitat);
        $em = $this->getDoctrine()->getManager();
        if ($peticion->getMethod() == 'POST') {
		$formulario->bind($peticion);
		if ($formulario->isValid()) {
			$em->persist($activitat);
			$em->flush();
			$id=$activitat->getId();
			$MyId = $this->get('nzo_url_encryptor')->encrypt($id);
			return $this->redirect($this->generateUrl('extranet_activitat_editar',  array( 'id'=> $MyId,'capprojecte'=> $AdminCapProjecte,'rol'=>$rolAdmin)));
			}
		}
        return $this->render('ActivitatBundle:Activitat:activitatnova.html.twig', array('capprojecte'=>'0','rol'=>$rolAdmin,'activitat' => '','accion' =>'crear','formulario' => $formulario->createView()));
    }

    public function ActivitatEditarAction($id)
	{
		$user = $this->container->get('security.context')->getToken()->getUser();
		$mail=$user->getEmail();
		$rols=$user->getRoles();
		$em = $this->getDoctrine()->getManager();
		$activitatentitat = $em->getRepository('ActivitatBundle:Activitat')->find($id);
		if (!$activitatentitat) {
			$MyId = $this->get('nzo_url_encryptor')->decrypt($id);
			$activitatentitat = $em->getRepository('ActivitatBundle:Activitat')->find($MyId);
			if (!$activitatentitat) {
				throw $this->createNotFoundException('Activitat inexistent');
			}
		}
		$tipusformador = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Formador'));
		$responsable = $em->getRepository('ClientBundle:Client')->findOneBy(array('Mail' =>$mail, 'TipusClient' => $tipusformador));
	     $Associats='0'; //$responsable->getAssociat();
		$AdminCapProjecte=$this->EsAdminCapProjecte($rols,$responsable,$Associats);
		$rolAdmin=$AdminCapProjecte;
  		$formulario = $this->createForm(new ActivitatType(), $activitatentitat);
		$peticion = $this->getRequest();
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				$baixa=$formulario->getData()->getBaixa();
				$em->persist($activitatentitat);
				$em->flush();
				if ($baixa=='true'){
					$LlistaCalendaris = $em->getRepository('ActivitatBundle:Activitat')->querycalendariactivitat($activitatentitat)->getResult();
					foreach ($LlistaCalendaris as $calendariDia) {	
						$calendariDia->setBaixa($baixa);
						$em->persist($calendariDia);
						$em->flush();
					}
				}
				$MyId = $this->get('nzo_url_encryptor')->encrypt($id);
				return $this->redirect($this->generateUrl('extranet_activitat_editar',  array( 'id'=> $MyId, 'capprojecte'=>$AdminCapProjecte, 'rol'=>$rolAdmin)));
			}
		}
		return $this->render('ActivitatBundle:Activitat:activitatnova.html.twig',
		array(
		'capprojecte'=>$AdminCapProjecte,
		'rol'=>$rolAdmin,
		'accion' =>'editar',
		'activitat' => $activitatentitat,
		'formulario' => $formulario->createView()
		)
		);
	}




	public function ActivitatPreviewAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$activitat = $em->getRepository('ActivitatBundle:Activitat')->find($id);
		if (!$activitat) {
			$MyId = $this->get('nzo_url_encryptor')->decrypt($id);
			$activitat = $em->getRepository('ActivitatBundle:Activitat')->find($MyId);
		}
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
		$llarg1='425';
		$llarg2='425';
		$llarg3='425';
		$llarg4='425';
		$llarg5='425';
		$llarg6='425';
		$llarg7='425';
		$llarg8='425';
        if (empty($camp1) or empty($camp2))
		{
            $class1='text_center';
            $class2='text_center';
            $align1='center';
            $align2='center';
            $llarg1='600';
            $llarg2='600';
		}
		if (empty($camp3) or empty($camp4))
		{
            $class3='text_center';
            $class4='text_center';
            $align3='center';
            $align4='center';
            $llarg3='600';
            $llarg4='600';
		}
		if (empty($camp5) or empty($camp6))
		{
            $class5='text_center';
            $class6='text_center';
            $align5='center';
            $align6='center';
            $llarg5='600';
            $llarg6='600';
		}
		if (empty($camp7) or empty($camp8))
		{
            $class7='text_center';
            $class8='text_center';
            $align7='center';
            $align8='center';
            $llarg7='600';
            $llarg8='600';
		}
		$host ='http://desenvolupament.vitaworke3.com' ;
		return $this->render('ActivitatBundle:Activitat:preview.html.twig',
		array('host'=>$host,'activitat'=>$activitat, 
			'class1'=>$class1,'align1'=>$align1,'llarg1'=>$llarg1,
			'class2'=>$class2,'align2'=>$align2,'llarg2'=>$llarg2,
			'class3'=>$class3,'align3'=>$align3,'llarg3'=>$llarg3,
			'class4'=>$class4,'align4'=>$align4,'llarg4'=>$llarg4,
			'class5'=>$class5,'align5'=>$align5,'llarg5'=>$llarg5,
			'class6'=>$class6,'align6'=>$align6,'llarg6'=>$llarg6,
			'class7'=>$class7,'align7'=>$align7,'llarg7'=>$llarg7,
			'class8'=>$class8,'align8'=>$align8,'llarg8'=>$llarg8,
			));
		}		


	public function EsAdminCapProjecte($Prols,$Presponsable,$Passociats)
	{
		$em = $this->getDoctrine()->getManager();
		$escapprojecte=0;
		foreach ($Prols as $rol){
    	    if ($rol=='ROLE_ADMIN'){	
				$escapprojecte=1;
		}}
		if (!empty($Presponsable)){
    	    $tipusempresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
    	    $tipusgrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
    	    $elements = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusempresa,$tipusgrup)->getResult();	
    	   	foreach ($elements as $element) {
    	       	$ClientResps=$element->getResponsable();
    	        foreach ($ClientResps as $ClientResp) {
    	        	if ($ClientResp==$Presponsable) {$escapprojecte=1;}
    	        	foreach ($Passociats as $Associat){
            			if ($ClientResp==$Associat){$escapprojecte=1;}
            		}
            	}
       		}
    	}
    $escapprojecte=1;
	return $escapprojecte;
	}

	public function CercaActivitatAction($PAdminEsCapProjecte,$PResponsable,$PAssociats)
	{
	    $em = $this->getDoctrine()->getManager();
	    $paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$activitats='';
		if ($PAdminEsCapProjecte==1)
		{	
			$activitats = $paginador->paginate($em->getRepository('ActivitatBundle:Activitat')->queryactivitats())->getResult();
    	}else{
			$activitats = $paginador->paginate($em->getRepository('ActivitatBundle:Activitat')->queryactivitatsresponsablecomite($PResponsable,$PAssociats))->getResult();
		}	
		return $activitats;
	}
}
