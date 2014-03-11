<?php
			
namespace vitaworke3\CalendariBundle\Entity;
use Doctrine\ORM\EntityRepository;
class CalendariRepository extends EntityRepository
{

public function enviarmail($calendari,$origen,$contenedor,$diaactivitat)
{

	$dataActivitat=$diaactivitat;
	$calendari->setDiaActivitat($dataActivitat);
	$client=$calendari->getClient();
    $nomClient=$client->getNom();
	$host ='http://vitawork.vitaworke3.com' ;
	// part nova a discutir el tema del assumpte, si omplim totes les dades obligatoriament o quins criteris cal tenir em compte.
	// a comentar amb el grup de treball
	$activitatdeldia=$calendari->getActivitat();
	$assumpte=$calendari->getassumpte();
	$titol1=$calendari->gettitol1();
	$titol2=$calendari->gettitol2();
	$nick=$calendari->getnick();
	$contingut=$calendari->getcontingut();
	$template=$client->gettemplate();
	if (empty($assumpte))
	{
		if (!empty($template))
		{
			$assumpte=$template->getassumpte();
		}
		if (empty($assumpte))
		{
			$assumpte=$activitatdeldia->getassumpte();
			if (empty($assumpte))
			{
				$assumpte='Vitawork E3: Tu dosis de bienestar.';
			}
		}	
	}
   if (empty($contingut))
	{
		if (!empty($template))
		{
			$contingut=$template->getcontingut();
		}
		
		if (empty($contingut))
		{
			$contingut=$activitatdeldia->getcontingut();
			if (empty($contingut))
			{
					$contingut='';
			}
		}	
	}
	if (empty($titol1))
	{
		if (!empty($template))
		{
			
			$titol1=$template->gettitol1();
			$titol2=$template->gettitol2();
			$nick=$template->getnick();
		
		}
		if (empty($titol1))
		{
			$titol1=$activitatdeldia->gettitol1();
			$titol2=$activitatdeldia->gettitol2();
			$nick=$activitatdeldia->getnick();
			if (empty($titol1))
			{
				$titol1='Hola';
				$titol2=',';
			}
		}	
	}
 		if (!empty($nick))
 		{
 			$nick=$client->getnick();
 		}
	if ($origen=='app')
	{
		$texto = $contenedor->renderView(
			'BackendBundle:Activitat:email.html.twig',array('usuari' => $client,'activitat'=>$activitatdeldia,'host'=>$host,'calendari'=>$calendari,'titol1'=>$titol1,'titol2'=>$titol2,'nick'=>$nick,'contingut'=>$contingut,'accio'=>'crear')
			);
		
	}else{		
		
		$texto = $contenedor->get('twig')->render(
			'BackendBundle:Activitat:email.html.twig',array('usuari' => $client,'activitat'=>$activitatdeldia,'host'=>$host,'calendari'=>$calendari,'titol1'=>$titol1,'titol2'=>$titol2,'nick'=>$nick,'contingut'=>$contingut,'accio'=>'crear')
		);

	}
	
	$mailclient=$client->getMail();
	if (!empty($mailclient)) 
	{
		$mensaje = \Swift_Message::newInstance()
		->setSubject($assumpte)
		->setFrom('letsgojazz@gmail.com')
		->setTo($mailclient)
		->setBody($texto,'text/html');
			
	
			$contenedor->get('mailer')->send($mensaje);
			$mailer = $contenedor->get('mailer');
            $transport = $contenedor->get('swiftmailer.transport.real');
            $spool = $mailer->getTransport()->getSpool();
            //$spool = $transport->getSpool();
			$spool->setMessageLimit(5);
			$spool->setTimeLimit(1);
		    $spool->flushQueue($transport);
               
            
		$enviada=new \DateTime('now');
		$calendari->setEnviada($enviada);
	}
    
      /*
    // enviament a tots els associats
	$LlistaAssociats = $em->getRepository('ClientBundle:Client')
	->findBy(array('Associat' =>$client));
	foreach ($LlistaAssociats as $AssociatClient) 
	{	
		$calendariAfegit = new Calendari();
		$calendariAfegit->setClient($AssociatClient);
		$calendariAfegit->setActivitat($activitatdeldia);
		$calendariAfegit->setDiaActivitat($dataActivitat);
		$em->persist($calendariAfegit);
		$em->flush();
		$nomClient=$AssociatClient->getNom();
		if ($origen='1')
		{
			$texto = $contenedor->renderView('BackendBundle:Activitat:email.html.twig',
			array('usuari' => $AssociatClient,'activitat'=>$activitatdeldia,'host'=>$host,'calendari'=>$calendariAfegit,'titol1'=>$titol1,'titol2'=>$titol2,'nick'=>$nick,'contingut'=>$contingut,'accio'=>'crear'));
		

		}else{		
			$texto = $contenedor->get('twig')->render('BackendBundle:Activitat:email.html.twig',
			array('usuari' => $AssociatClient,'activitat'=>$activitatdeldia,'host'=>$host,'calendari'=>$calendariAfegit,'titol1'=>$titol1,'titol2'=>$titol2,'nick'=>$nick,'contingut'=>$contingut,'accio'=>'crear'));
			
		}
		$mailclient=$AssociatClient->getMail();
		if (!empty($mailclient)) 
		{
			$mensaje = \Swift_Message::newInstance()
			->setSubject($assumpte)
			->setFrom('mailing@vitaworke3.com')
			->setTo($mailclient)
			->setBody($texto,'text/html');
			$contenedor->get('mailer')->send($mensaje);
			$enviada=new \DateTime('now');
			$calendariAfegit->setEnviada($enviada);
		}
							
	}
	*/
	return 'ok';
	}

public function querycalendari()
{
	$em = $this->getEntityManager();
	$consulta = $em->createQuery('
	SELECT o FROM CalendariBundle:Calendari o');
	return $consulta;
}

public function querycalendarifiltre($idclient,$idactivitat)
{
	
    $query='SELECT o FROM ActivitatBundle:Activitat o WHERE o.id>0';
	
    $query='SELECT o FROM CalendariBundle:Calendari o WHERE o.id>0';
	
	if (!empty($idclient)){ $query.=' AND  o.Client=:idclient';}
    if (!empty($idactivitat)){ $query.=' AND  o.Activitat=:idactivitat';}
	
	$em = $this->getEntityManager();
    $consulta = $em->createQuery($query);
  	
  	if (!empty($idclient)){ $consulta->setParameter('idclient', $idclient);}
    if (!empty($idactivitat)){$consulta->setParameter('idactivitat', $idactivitat);}
	
	return $consulta;
}
public function querycalendariplanning($client,$limite=null)
{
	$em = $this->getEntityManager();
	$consulta = $em->createQuery('
	SELECT o.id FROM CalendariBundle:Calendari o
	where o.Client=:client');
	$consulta->setParameter('client', $client);
	$consulta->getMaxResults(1);
	return $consulta->getResult();
}

public function queryclientcalendarifiltre($tipusclient,$idassociat)
  {
	
    $query='SELECT o FROM ClientBundle:Client o WHERE o.TipusClient=:tipusclient';
	
	if (!empty($idassociat)){ $query.=' AND  o.Associat=:idassociat';}
    
	$em = $this->getEntityManager();
    $consulta = $em->createQuery($query);
    $consulta->setParameter('tipusclient', $tipusclient);
	
	if (!empty($idassociat)){ $consulta->setParameter('idassociat', $idassociat);}
    
	return $consulta;
  
  }

}