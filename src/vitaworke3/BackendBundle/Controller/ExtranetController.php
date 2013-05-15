<?php

namespace vitaworke3\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use vitaworke3\BackendBundle\Form\Extranet\ActivitatType;
use vitaworke3\ActivitatBundle\Entity\Activitat;
use vitaworke3\CalendariBundle\Entity\Calendari;
use vitaworke3\BackendBundle\Form\Extranet\CalendariType;
use vitaworke3\ClientBundle\Entity\Client;
use vitaworke3\BackendBundle\Form\Extranet\CalendariValorarType;
use vitaworke3\BackendBundle\Form\Extranet\TestInicialType;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class ExtranetController extends Controller
{
    public function portadaAction()
    {
        return $this->render('BackendBundle:Extranet:portada.html.twig');
    }

     public function CalendariAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
		$calendaris = $em->getRepository('CalendariBundle:Calendari')
		->findAll();
		return $this->render('BackendBundle:Extranet:calendari.html.twig', array(
		'calendaris' => $calendaris
		)); 


        
    }



    public function ActivitatAction()
    {
       	$em = $this->getDoctrine()->getEntityManager();
		$activitats = $em->getRepository('ActivitatBundle:Activitat')
		->findAll();
		return $this->render('BackendBundle:Extranet:activitat.html.twig', array(
		'activitats' => $activitats
)); 


        
    }

    public function ActivitatNovaAction()
    {
        $peticion = $this->getRequest();
        $activitat = new Activitat();
        $formulario = $this->createForm(new ActivitatType(), $activitat);
        $em = $this->getDoctrine()->getEntityManager();
        if ($peticion->getMethod() == 'POST') {
				$formulario->bind($peticion);
				if ($formulario->isValid()) {
					
					$activitat ->uploadImatge();
					$activitat->uploadMultimedia();
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
				 $associatsCalendari=$formulario->getData()->getAssociats();
				 $enviar=$formulario->getData()->getEnviar();
				 $client=$calendari->getClient();
				 $nomClient=$client->getNom();
				if ($enviar=='true')
				{
					
					$dataActivitat=new \DateTime('today');
					$calendari->setDiaActivitat($dataActivitat);
			    	$em->persist($calendari);
					$em->flush();
					$host = 'dev' == 'env' ?
					'http://vitaworke3.local' :
					'http://vitaworke3.com';
					$activitatdeldia=$calendari->getActivitat();
					$texto = $this->renderView(
					'BackendBundle:Activitat:email.html.twig',array('usuari' => $client,'activitat'=>$activitatdeldia,'host'=>$host,'calendari'=>$calendari)
					);
					$mailclient=$client->getMail();
					if (!empty($mailclient)) 
					{
						$mensaje = \Swift_Message::newInstance()
						->setSubject($nomClient)
						->setFrom('mailing@vitaworke3.com')
						->setTo('92877@parcdesalutmar.cat')
						->setBody($texto,'text/html');
						$this->get('mailer')->send($mensaje);
					}
					$calendari->setEnviada(true);	
				}
				else
				{						
					$dataActivitat=$formulario->getData()->getDiaActivitat();
					$calendari->setDiaActivitat($dataActivitat);
			    	
			    }
					$em->persist($calendari);
					$em->flush();
			
			  	$this->get('session')->setFlash('info',
				'Los datos de tu perfil se han actualizado correctamente'
				);
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
			$imatgeOriginal = $formulario->getData()->getImatge();
			$multimediaOriginal = $formulario->getData()->getMultimedia();
			$formulario->bind($peticion);
			if ($formulario->isValid()) {
				if (null == $activitat->getImatge()) {
				$activitat->setImatge($imatgeOriginal);
				} else {
					
				$activitat->uploadImatge();
				//unlink($directoriFotografies.$fotoOriginal);
				}
				if (null == $activitat->getMultimedia()) {
				$activitat->setMultimedia($multimediaOriginal);
				} else {
					
				$activitat->uploadMultimedia();
				//unlink($directoriFotografies.$fotoOriginal);
				}
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
			if ($tipologia='Tipologia 1')
			{
				$formulario=$this->createForm(new TestInicialType(),$calendari);
				if ($peticion->getMethod() == 'POST') 
				{
					$formulario->bind($peticion);
					$calendari->setRealitzada(true);	
					$em->persist($calendari);
					$em->flush();
					return $this->render('BackendBundle:Extranet:valorattestinicial.html.twig',array('formulario' => $formulario->createView()));
					
				}

					
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
					$formulario->bind($peticion);
					$calendari->setRealitzada(true);	
					$valoracio = $formulario->getData()->getValoracio();
					$calendari->setValoracio($valoracio);
					$em->persist($calendari);
					$em->flush();
					return $this->render('BackendBundle:Extranet:valorat.html.twig',array('formulario' => $formulario->createView()));
					
				}
			

				return $this->render('BackendBundle:Extranet:activitatvisualitzar.html.twig',
				array(
				'calendari'=>$calendari,
				'activitat' => $activitat,
				'formulario' => $formulario->createView()
				));
	
			}
			
			
		}
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


}

