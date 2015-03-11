<?php

namespace vitaworke3\CalendariBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use vitaworke3\BackendBundle\Form\Extranet\ActivitatType;
use vitaworke3\CalendariBundle\Entity\Calendari;
use vitaworke3\CalendariBundle\Entity\Planning;
use vitaworke3\CalendariBundle\Form\CalendariType;
use vitaworke3\CalendariBundle\Form\CalendariValorarType;
use vitaworke3\CalendariBundle\Form\PlanningNouType;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\SecurityContext;

class CalendariController extends Controller
{

	public function CalendariAction()
    {
       	$em = $this->getDoctrine()->getManager();
       	$user = $this->container->get('security.context')->getToken()->getUser();
       	$mail=$user->getEmail();
		$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusClient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Client'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
		$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$clients = $em->getRepository('ClientBundle:Client')->querygrupempresaclient($tipusGrup,$tipusEmpresa,$tipusClient)->getResult();
    	$rols=$user->getRoles();
		$rolAdmin=0;
		$escapprojecte=0;
		foreach ($rols as $rol){
        	if ($rol=='ROLE_ADMIN'){	
				$rolAdmin=1;
				$escapprojecte == 1;
		}}
		$responsable = $em->getRepository('ClientBundle:Client')->findOneBy(array('Mail' =>$mail));
		$activitats='';
		if (!empty($responsable)){
    	    $tipusempresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
    	    $tipusgrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
    	    $elements = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusempresa,$tipusgrup)->getResult();	
    	    $Associats=$responsable->getAssociat();
    	    foreach ($elements as $element) {
    	       	$ClientResps=$element->getResponsable();
    	        foreach ($ClientResps as $ClientResp) {
    	        	if ($ClientResp==$responsable) {$escapprojecte=1;}
    	        	foreach ($Associats as $Associat){
    	        		if ($ClientResp==$Associat){$escapprojecte=1;}
    	        	}
            	}
        	}
	    }
	    if ($rolAdmin==1 || $escapprojecte == 1 ){	
			$activitats = $paginador->paginate($em->getRepository('ActivitatBundle:Activitat')->queryactivitats())->getResult();
     	}else{
			$activitats = $paginador->paginate($em->getRepository('ActivitatBundle:Activitat')->queryactivitatsresponsablecomite($responsable,$Associats))->getResult();
		}
		$calendaris = $paginador->paginate(
		$em->getRepository('CalendariBundle:Calendari')->querycalendari()
		)->getResult();
		return $this->render('CalendariBundle:Calendari:calendari.html.twig', array(
		'calendaris' => $calendaris,
		'paginador' => $paginador,
		'activitats'=>$activitats,
		'idactivitat'=>'0',
		'clients'=>$clients,
		'idclient'=>'0',
		'user'=>$user,
		'mail'=>$mail,
		'responsable'=>$responsable
		)); 
	}

public function CalendariFiltreAction($idclient,$idactivitat)
    {
       	$em = $this->getDoctrine()->getManager();
       	$user = $this->container->get('security.context')->getToken()->getUser();
       	$mail=$user->getEmail();
		$paginador = $this->get('ideup.simple_paginator');
		$paginador->setItemsPerPage(20);
		$paginador->setMaxPagerItems(5);
		$tipusClient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Client'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
		$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$clients = $em->getRepository('ClientBundle:Client')->querygrupempresaclient($tipusGrup,$tipusEmpresa,$tipusClient)->getResult();
    	$rols=$user->getRoles();
		$rolAdmin=0;
		foreach ($rols as $rol){
        	if ($rol=='ROLE_ADMIN'){	
				$rolAdmin=1;
				$escapprojecte == 1;
		}}
		$responsable = $em->getRepository('ClientBundle:Client')->findOneBy(array('Mail' =>$mail));
		$activitats='';
		if (!empty($responsable)){
    	    $tipusempresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
    	    $tipusgrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
    	    $elements = $em->getRepository('ClientBundle:Client')->querygrupempresa($tipusempresa,$tipusgrup)->getResult();	
    	    $Associats=$responsable->getAssociat();
    	    foreach ($elements as $element) {
    	       	$ClientResps=$element->getResponsable();
    	        foreach ($ClientResps as $ClientResp) {
    	        	if ($ClientResp==$responsable) {$escapprojecte=1;}
    	        	foreach ($Associats as $Associat){
    	        		if ($ClientResp==$Associat){$escapprojecte=1;}
    	        	}
            	}
        	}
	    }
	    if ($rolAdmin==1 || $escapprojecte == 1 ){	
			$activitats = $paginador->paginate($em->getRepository('ActivitatBundle:Activitat')->queryactivitats())->getResult();
     	}else{
			$activitats = $paginador->paginate($em->getRepository('ActivitatBundle:Activitat')->queryactivitatsresponsablecomite($responsable,$Associats))->getResult();
		}
		$calendaris = $paginador->paginate(
		$em->getRepository('CalendariBundle:Calendari')->querycalendarifiltre($idclient,$idactivitat)
		)->getResult();
		return $this->render('CalendariBundle:Calendari:calendari.html.twig', array(
		'calendaris' => $calendaris,
		'paginador' => $paginador,
		'activitats'=>$activitats,
		'idactivitat'=>$idactivitat,
		'clients'=>$clients,
		'idclient'=>$idclient,
		'user'=>$user,
		'mail'=>$mail,
		'responsable'=>$responsable
		)); 
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
				 $em = $this->getDoctrine()->getManager();
				 $enviar=$formulario->getData()->getEnviar();
				 $contenedor = $this;
				if ($enviar=='true'){
					$diaactivitat=new \DateTime('today');
					$calendari->setDiaActivitat($diaactivitat);
					$em->persist($calendari);
					$em->flush();
					$enviament = $em->getRepository('CalendariBundle:Calendari')->enviarmail($calendari,'app',$contenedor,$diaactivitat);
					$em->persist($calendari);
					$em->flush();
					$client=$calendari->getClient();
					$LlistaAssociats = $em->getRepository('CalendariBundle:Calendari')->queryclientcalendarifiltre($client)->getResult();
					foreach ($LlistaAssociats as $AssociatClient) {	
						$CrearCalendari=$this->CrearCalendari($calendari,$AssociatClient,$contenedor);
						$tipusClientAssociat=$AssociatClient->getTipusClient();
						if ($tipusClientAssociat=='Grup' || $tipusClientAssociat=='Empresa'){
							$LlistaAssociatsClient= $em->getRepository('CalendariBundle:Calendari')->queryclientcalendarifiltre($AssociatClient)->getResult();
							foreach ($LlistaAssociatsClient as $AssociatClientNivell2) {
								$CrearCalendari=$this->CrearCalendari($calendari,$AssociatClientNivell2,$contenedor);		
							}	
						}
					}
				}
				else{						
					$dataActivitat=$formulario->getData()->getDiaActivitat();
					$calendari->setDiaActivitat($dataActivitat);
					$em->persist($calendari);
					$em->flush();
				}
			    $id=$calendari->getId();
			    $MyId = $this->get('nzo_url_encryptor')->encrypt($id);
				return $this->redirect($this->generateUrl('extranet_calendari_editar',  array( 'id'=> $MyId)));
			}
		}
        return $this->render('CalendariBundle:Calendari:calendarinou.html.twig', array('accion' =>'crear','formulario' => $formulario->createView()));
    }
	
    public function CrearCalendari($pCalendari,$pClient,$pContenedor)
    {
   		$em = $this->getDoctrine()->getManager();
		$activitatdeldia=$pCalendari->getActivitat();
		$assumpte=$pCalendari->getassumpte();
		$titol1=$pCalendari->gettitol1();
		$titol2=$pCalendari->gettitol2();
		$nick=$pCalendari->getnick();
		$contingut=$pCalendari->getcontingut();
		$calendariAfegit = new Calendari();
		$calendariAfegit->setClient($pClient);
		$calendariAfegit->setActivitat($activitatdeldia);
		if (!empty($assumpte)){$calendariAfegit->setAssumpte($assumpte);}
		if (!empty($titol1)){$calendariAfegit->setTitol1($titol1);}
		if (!empty($titol2)){$calendariAfegit->setTitol2($titol2);}
		if (!empty($nick)){$calendariAfegit->setNick($nick);}
		if (!empty($contingut)){$calendariAfegit->setContingut($contingut);}
		$dataActivitat=new \DateTime('today');
		$calendariAfegit->setDiaActivitat($dataActivitat);
		$em->persist($calendariAfegit);
		$em->flush();
		$enviament = $em->getRepository('CalendariBundle:Calendari')->enviarmail($calendariAfegit,'app',$pContenedor,$dataActivitat);
		$em->persist($calendariAfegit);
		// comentari
		$em->flush();
		return 1;		
    }


	public function CalendariNouPlanningAction($accion,$idempresa,$id,$idany,$idmes,$iddia,$idcalendari)
    {
        $em = $this->getDoctrine()->getManager();
        if ($accion=='editar'){
		 	$calendari = $em->getRepository('CalendariBundle:Calendari')->find($idcalendari);
		}else{
        	$calendari = new Calendari();
        }
        $formulario = $this->createForm(new PlanningNouType(), $calendari);
        $data = $idany."-".$idmes."-".$iddia;
		$diaactivitat = new \DateTime($data);
		$avui = date("Ymd");
		$source=$idany.$idmes.$iddia;
		$peticion = $this->getRequest();
		$clientNom = $em->getRepository('ClientBundle:Client')->find($id);
		$nomclient=$clientNom->getNom();		
		if ($peticion->getMethod() == 'POST'){
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				 $em = $this->getDoctrine()->getManager();
				 $enviar=$formulario->getData()->getEnviar();
				 $contenedor = $this;
				 $client = $em->getRepository('ClientBundle:Client')->find($id);
				 $calendari->setClient($client);
				 $data = $idany."-".$idmes."-".$iddia;
				 $diaactivitat = new \DateTime($data);
				 if ($enviar=='true')
				 {
					$calendari->setDiaActivitat($diaactivitat);
					$em->persist($calendari);
					$em->flush();
					$enviament = $em->getRepository('CalendariBundle:Calendari')->enviarmail($calendari,'app',$contenedor,$diaactivitat);
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
        			$LlistaAssociats = $em->getRepository('CalendariBundle:Calendari')->queryclientcalendarifiltre($tipusclient,$client)->getResult();
					foreach ($LlistaAssociats as $AssociatClient) {	
						$calendariAfegit = new Calendari();
						$calendariAfegit->setClient($AssociatClient);
						$calendariAfegit->setActivitat($activitatdeldia);
						if (!empty($assumpte)){$calendariAfegit->setAssumpte($assumpte);}
						if (!empty($titol1)){$calendariAfegit->setTitol1($titol1);}
						if (!empty($titol2)){$calendariAfegit->setTitol2($titol2);}
						if (!empty($nick)){$calendariAfegit->setNick($nick);}
						if (!empty($contingut)){$calendariAfegit->setContingut($contingut);}
						$dataActivitat=new \DateTime('today');
						$calendariAfegit->setDiaActivitat($dataActivitat);
						$em->persist($calendariAfegit);
						$em->flush();
						$enviament = $em->getRepository('CalendariBundle:Calendari')->enviarmail($calendariAfegit,'app',$contenedor,$diaactivitat);
						$em->persist($calendariAfegit);
						$em->flush();
					}
				}
				else{						
					$calendari->setDiaActivitat($diaactivitat);
					$em->persist($calendari);
					$em->flush();
				}
			if ($accion=='crear'){
		 		$idcalendari = $calendari->getId();
		 	}
		    $MyId = $this->get('nzo_url_encryptor')->encrypt($idcalendari);
			 
			return $this->redirect($this->generateUrl('extranet_calendari_nou_planning', array( 'accion'=>'editar' ,'idempresa'=> $idempresa , 'id'=>$id , 'idany'=>$idany ,'idmes'=>$idmes , 'iddia'=> $iddia , 'idcalendari'=>$MyId )));
				
			}
		}
		return $this->render('CalendariBundle:Calendari:planningnou.html.twig', array('nomclient'=>$nomclient,'calendari'=>$calendari,'data'=>$source,'avui'=>$avui,'idempresa'=>$idempresa,'idany'=>$idany,'idmes'=>$idmes,'iddia'=>$iddia,'client'=>$id,'dia'=>$diaactivitat,'accion' =>$accion, 'idcalendari'=>$idcalendari,'formulario' => $formulario->createView()));
    }

public function CalendariActivitatVisualitzarAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$MyId = $this->get('nzo_url_encryptor')->decrypt($id);
		$calendari = $em->getRepository('CalendariBundle:Calendari')->find($MyId);
		if (!$calendari){
				throw $this->createNotFoundException('Activitat per aquest dia no assignada al calendari');
		}
		// em de revisar si el fet de que la valoració estigui feta, invalida el tornar a fer i valorar la activitat, per altra banda, tambe hem de veure perque
		// el diescaducitat es modifica al modificar el diacomparar.
		// ens queda tambe realitzar un template per el error invocar aquest error.html.twig en el cas que no trobi activitat assignada per aquest dia.
		$activitat=$calendari->getActivitat();
		$diescaducitat=$calendari->getDiesCaducitat();
		if (empty($diescaducitat)){
			$diescaducitat=$activitat->getDiesCaducitat();
		}
		$diaactivitat=$calendari->getDiaActivitat();
		$valoracio=$calendari->getValoracio();
		$date1 = new \DateTime("now");
		$diacomparar=$diaactivitat;
		if ($diescaducitat>0){
			$interval="P".$diescaducitat."D";
        	$diacomparar->add(new \DateInterval($interval));
        }	
		if (($diescaducitat>0) and ($date1>$diacomparar)){	
			return $this->render('CalendariBundle:Calendari:error.html.twig',array('diaactivitat'=>$diaactivitat,'ara'=>$date1,'diainterval'=>$diacomparar,'valoracio'=>$valoracio));
		}else{
			$peticion = $this->getRequest();
			$tipologia=$activitat->getTipologia();
			if ($tipologia == 'Tipologia 99'){
				$formulario=$this->createForm(new TestInicialType(),$calendari);
				if ($peticion->getMethod() == 'POST') {
					$formulario->bind($peticion);
					$valorada = new \DateTime("now");
					$calendari->setValorada($valorada);	
					$em->persist($calendari);
					$em->flush();
					return $this->render('CalendariBundle:Calendari:valorattestinicial.html.twig',array('formulario' => $formulario->createView()));
				}
				$oberta = new \DateTime("now");
				$calendari->setOberta($oberta);	
				return $this->render('CalendariBundle:Calendari:testinicial.html.twig',
				array(
				'calendari'=>$calendari,
				'activitat' => $activitat,
				'formulario' => $formulario->createView()
				));
			}else{
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
				$llarg1='400';
				$llarg2='400';
				$llarg3='400';
				$llarg4='400';
				$llarg5='400';
				$llarg6='400';
				$llarg7='400';
				$llarg8='400';
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
				$formulario = $this->createForm(new CalendariValorarType());
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
					$calendari->setValoracio($valoracio);
					$valorada=new \DateTime('now');
					$calendari->setValorada($valorada);	
					$em->persist($calendari);
					$em->flush();
					//return $this->render('BackendBundle:Extranet:valorat.html.twig',array( 'calendari'=>$calendari,'formulario' => $formulario->createView()));
					$id=$calendari->getId();
					return $this->render('CalendariBundle:Calendari:activitatvisualitzar.html.twig',
				array(
				'calendari'=>$calendari,
				'activitat' => $activitat,
				'class1'=>$class1,'align1'=>$align1,'llarg1'=>$llarg1,
				'class2'=>$class2,'align2'=>$align2,'llarg2'=>$llarg2,
				'class3'=>$class3,'align3'=>$align3,'llarg3'=>$llarg3,
				'class4'=>$class4,'align4'=>$align4,'llarg4'=>$llarg4,
				'class5'=>$class5,'align5'=>$align5,'llarg5'=>$llarg5,
				'class6'=>$class6,'align6'=>$align6,'llarg6'=>$llarg6,
				'class7'=>$class7,'align7'=>$align7,'llarg7'=>$llarg7,
				'class8'=>$class8,'align8'=>$align8,'llarg8'=>$llarg8,
				'formulario' => $formulario->createView()
					));
				}
				$oberta=new \DateTime('now');
				$calendari->setOberta($oberta);	
				$em->persist($calendari);
				$em->flush();
				return $this->render('CalendariBundle:Calendari:activitatvisualitzar.html.twig',
				array(
				'calendari'=>$calendari,
				'activitat' => $activitat,
				'class1'=>$class1,'align1'=>$align1,'llarg1'=>$llarg1,
				'class2'=>$class2,'align2'=>$align2,'llarg2'=>$llarg2,
				'class3'=>$class3,'align3'=>$align3,'llarg3'=>$llarg3,
				'class4'=>$class4,'align4'=>$align4,'llarg4'=>$llarg4,
				'class5'=>$class5,'align5'=>$align5,'llarg5'=>$llarg5,
				'class6'=>$class6,'align6'=>$align6,'llarg6'=>$llarg6,
				'class7'=>$class7,'align7'=>$align7,'llarg7'=>$llarg7,
				'class8'=>$class8,'align8'=>$align8,'llarg8'=>$llarg8,
				'formulario' => $formulario->createView()
				));
			}
		}
	}

public function CalendariValorarAction($id)
{
	    $em = $this->getDoctrine()->getManager();
		$calendari = $em->getRepository('CalendariBundle:Calendari')->find($id);
		if (!$calendari) {
				$MyId = $this->get('nzo_url_encryptor')->decrypt($id);
				$calendari = $em->getRepository('CalendariBundle:Calendari')->find($MyId);
				if (!$calendari){
					throw $this->createNotFoundException('Activitat per aquest dia no assignada al calendari');
				}
			}
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
		return $this->render('CalendariBundle:Calendari:valorat.html.twig',array('calendari'=>$calendari, 'formulario' => $formulario->createView()));

}
public function CalendariEditarAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$calendari = $em->getRepository('CalendariBundle:Calendari')->find($id);
		if (!$calendari) {
			$MyId = $this->get('nzo_url_encryptor')->decrypt($id);
			$calendari = $em->getRepository('CalendariBundle:Calendari')->find($MyId);
			if (!$calendari) {
				throw $this->createNotFoundException('Calendari inexistent');
			}
		}
	
		$peticion = $this->getRequest();
		$formulario = $this->createForm(new CalendariType(), $calendari);
		if ($peticion->getMethod() == 'POST') {
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
			    $em = $this->getDoctrine()->getManager();
				$em->persist($calendari);
				$em->flush();
				
				}
				$MyId = $this->get('nzo_url_encryptor')->encrypt($id);
				return $this->redirect($this->generateUrl('extranet_calendari_editar',  array( 'id'=> $MyId)));
			}
		
		return $this->render('CalendariBundle:Calendari:calendarinou.html.twig',
		array(
		'accion' =>'editar',
		'calendari' => $calendari,
		'formulario' => $formulario->createView()
		)
		);
	}


public function CalendariVisualitzarAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$calendari = $em->getRepository('CalendariBundle:Calendari')->find($id);
		if (!$calendari) {throw $this->createNotFoundException('Calendari inexistent');}
		$activitat=$calendari->getActivitat();
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
        if (empty($camp1) or empty($camp2)){
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
		$host ='http://vitawork.vitaworke3.com' ;
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
			'calendari' => $calendari,
			));
		
	}	

public function CalendariEmailAction($id)
	{

 		$em = $this->getDoctrine()->getManager();
		$calendari = $em->getRepository('CalendariBundle:Calendari')->find($id);
		$activitat=$calendari->getActivitat();
		$client=$calendari->getClient();
		$nomClient=$client->getNom();
		$host ='http://vitawork.vitaworke3.com' ;
		return $this->render('CalendariBundle:Calendari:email.html.twig',
		array(
		'usuari' => $client,'activitat'=>$activitat,'host'=>$host,'calendari'=>$calendari
		,'accio' =>'editar')
		);
		
	}
 
  

	public function PlanningEmpresaAction()
    {
       	$em = $this->getDoctrine()->getManager();
       	$mesos = $em->getRepository('CalendariBundle:Mesos')->findAll();
       	$anys = array('2013','2014','2015','2016');
       	$idany=date('Y');
       	$idmes=date('m');
      	$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
		$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
		$user = $this->container->get('security.context')->getToken()->getUser();
       	$mail=$user->getEmail();
		$responsable = $em->getRepository('ClientBundle:Client')->findOneBy(array('Mail' =>$mail));
		$plannings='';
		$rols=$user->getRoles();
		$rolAdmin=0;
		foreach ($rols as $rol){
			if ($rol=='ROLE_ADMIN'){$rolAdmin=1;}
		 }
		if ($rolAdmin==1){	
			$clients =$em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();
		}else{
			$clients = $em->getRepository('ClientBundle:Client')->queryplanningresponsable($tipusGrup,$tipusEmpresa,$responsable)->getResult();	
		}
		$dies=date("t",mktime(0,0,0,$idmes+1,0,$idany));
		$planning = array();
     	foreach ($clients as $client) {
        	$id = $client->getId();
        	$nom = $client->getNom();
        	for ($i=1; $i<=$dies; $i++)
        	{
    			$sweditar='0';
    			$plannings[$id][0]=array('id'=>'0','nom'=>$nom ,'client'=>$id);
    			$dia=$i;
    			if (strlen($i)==1){$dia="0".$i;}
        		$source = $idany."-".$idmes."-".$dia;
        		$data=$idany.$idmes.$dia;
				$diaactivitat = new \DateTime($source);
				$calendari = $em->getRepository('CalendariBundle:Calendari')->findOneBy(array(
				'Client' => $client,'DiaActivitat'=>$diaactivitat));
        		$idcalendari='';
        		$descripcio='NO';	
        		$avui = date("Ymd");
        		if ($data < $avui){$sweditar='1';}
        		if (!empty($calendari)){
        			$descripcio='CR';	
        			$idcalendari=$calendari->getId();
        			$oberta=$calendari->getOberta();
        			$enviada=$calendari->getEnviada();
        			$valorada=$calendari->getValorada();
        			if (!empty($enviada))
        			{
        					$descripcio='EV';
        			}
        			if (!empty($oberta))
        			{
        					$descripcio='OB';
        			}
        			if (!empty($valorada))
        			{
        					$descripcio='VA';
        			}
        		}
        		$plannings[$id][$i]=array('id'=>$i,'dia'=>$dia,'descripcio'=>$descripcio,'calendari'=>$calendari,'idcalendari'=>$idcalendari,'sw'=>$sweditar,'client'=>$id,'data'=>$data,'avui'=>$avui);
    		}
    	} 
		return $this->render('CalendariBundle:Calendari:PPlanning.html.twig',array(
		'origen' =>'empresa',
		'anys' => $anys,
		'idany'=>$idany,
		'mesos' => $mesos,
		'dies'=>$dies,
		'idmes'=>$idmes,
		'clients' => $clients,
		'plannings'=>$plannings,
		'idempresa'=>'zzz',
		'user'=>$user,
		'mail'=>$mail,
		'responsable'=>$responsable)
		); 
	}
  public function PlanningFiltreAction($idany,$idmes,$idempresa)
    {
       	$em = $this->getDoctrine()->getManager();
       	$mesos = $em->getRepository('CalendariBundle:Mesos')->findAll();
       	$anys = array('2013','2014','2015','2016','2017');
       	$origen='client';
      	if ($idempresa=='zzz')
      	{
      		$origen='empresa';
      		$tipusGrup = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Grup'));
			$tipusEmpresa = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Empresa'));
			$user = $this->container->get('security.context')->getToken()->getUser();
       		$mail=$user->getEmail();
			$responsable = $em->getRepository('ClientBundle:Client')->findOneBy(array('Mail' =>$mail));
			$plannings='';
			$rols=$user->getRoles();
			$rolAdmin=0;
			foreach ($rols as $rol)
			 {
				if ($rol=='ROLE_ADMIN')
				{	
					$rolAdmin=1;
				}
			 }
			if ($rolAdmin==1)
			{	
				$clients =$em->getRepository('ClientBundle:Client')->querygrupempresa($tipusGrup,$tipusEmpresa)->getResult();

			}else
			{
				$clients = $em->getRepository('ClientBundle:Client')->queryplanningresponsable($tipusGrup,$tipusEmpresa,$responsable)->getResult();	
			}
			
      	}else
      	{
      		$origen='client';
      		$tipusclient = $em->getRepository('ClientBundle:TipusClient')->findOneBy(array('slug' => 'Client'));	
      		$clients = $em->getRepository('CalendariBundle:Calendari')->queryclientcalendarifiltre($tipusclient,$idempresa)->getResult();
      	}
      	
      	$dies=date("t",mktime(0,0,0,$idmes+1,0,$idany));
	    $planning = array();
        foreach ($clients as $client) {
        	$id = $client->getId();
        	$nom = $client->getNom();
        	for ($i=1; $i<=$dies; $i++)
        	{
    			$sweditar='0';
    			$plannings[$id][0]=array('id'=>'0','nom'=>$nom,'client'=>$id);
    			$dia=$i;
    			if (strlen($i)==1)
    			{
    				$dia="0".$i;
    			}
        	
        		$source = $idany."-".$idmes."-".$dia;
				$diaactivitat = new \DateTime($source);
				$calendari = $em->getRepository('CalendariBundle:Calendari')->findOneBy(array('Client' => $client,'DiaActivitat'=>$diaactivitat));
        		$idcalendari='';
        		$descripcio='NO';	
        		$avui = date("Ymd");
        		$mes=$idmes;
        		if (strlen($mes)==1)
    			{
    				$mes="0".$mes;
    			}
        		$data=$idany.$mes.$dia;
        		
        		if ($data < $avui)
        		{
        			$sweditar='1';
        		}
        		if (!empty($calendari))
				{
        			$descripcio='CR';	
        			$idcalendari=$calendari->getId();
        			$oberta=$calendari->getOberta();
        			$enviada=$calendari->getEnviada();
        			$valorada=$calendari->getValorada();
        			if (!empty($enviada))
        			{
        					$descripcio='EV';
        			}
        			if (!empty($oberta))
        			{
        					$descripcio='OB';
        			}
        			if (!empty($valorada))
        			{
        					$descripcio='VA';
        			}
        		}
        		$plannings[$id][$i]=array('id'=>$i,'dia'=>$dia,'descripcio'=>$descripcio,'calendari'=>$calendari,'idcalendari'=>$idcalendari,'sw'=>$sweditar,'client'=>$id);
    			
			}
       
		
        } 
    	return $this->render('CalendariBundle:Calendari:PPlanning.html.twig',array(
		'origen' =>$origen,
		'anys' => $anys,
		'idany'=>$idany,
		'mesos' => $mesos,
		'dies'=>$dies,
		'idmes'=>$idmes,
		'clients' => $clients,
		'plannings'=>$plannings,
		'idempresa'=>$idempresa)
		); 

        
    }


}