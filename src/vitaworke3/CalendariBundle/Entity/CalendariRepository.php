<?php
			
namespace vitaworke3\CalendariBundle\Entity;
use Doctrine\ORM\EntityRepository;
class CalendariRepository extends EntityRepository
{

public function enviarmail($calendari,$origen,$contenedor)
{

	$dataActivitat=new \DateTime('today');
	$calendari->setDiaActivitat($dataActivitat);
	$client=$calendari->getClient();
    $nomClient=$client->getNom();
	$host ='http://vitaworke3.local' ;
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
				$assumpte='Vitawork E3: La teva dosis de benestar.';
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
					$contingut='contingut';
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
				$nick=$client->getnick();
			}
		}	
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
		->setFrom('vitaworke3@vitaworke3.com')
		->setTo($mailclient)
		->setBody($texto,'text/html');
		$contenedor->get('mailer')->send($mensaje);
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

public function querycalendariavui()
{
	$em = $this->getEntityManager();
	$consulta = $em->createQuery('
	SELECT o FROM CalendariBundle:Calendari o');
	
	return $consulta;
}

}