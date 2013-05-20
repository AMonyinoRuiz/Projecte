<?php

namespace vitaworke3\CalendariBundle\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use vitaworke3\ActivitatBundle\Entity\Activitat;
use vitaworke3\CalendariBundle\Entity\Calendari;
use vitaworke3\BackendBundle\Form\Extranet\CalendariType;
use vitaworke3\ClientBundle\Entity\Client;


class EMailActivitatDelDiaCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
		->setName('email:activitat-del-dia')
		->setDescription('Genera i envia a cada usuari la activitat diaria');
				
	}
	
	
	protected function interact(InputInterface $input, OutputInterface $output)
	{
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
			$output->writeln('inici proces <fg=magenta> generacio de emails</>...');
			$host ='http://vitaworke3.local/app.php' ;
			$contenedor = $this->getContainer();
			$em = $contenedor->get('doctrine')->getEntityManager();	
			$Calendari = array();
			$DataEnviament = new \DateTime('today');
			$Calendaris = $em->getRepository('CalendariBundle:Calendari')->findBy(array('DiaActivitat' => $DataEnviament));
			foreach ($Calendaris as $Calendari)
			{
				$clientoriginal=$Calendari->getClient();
				$activitatdeldia=$Calendari->getActivitat();
				$enviada=$Calendari->getEnviada();
				$host = 'dev' == 'env' ?
					'http://vitaworke3.local' :
					'http://vitaworke3.com';
				$texto = $contenedor->get('twig')->render(
					'BackendBundle:Activitat:email.html.twig',array('usuari' => $clientoriginal,'activitat'=>$activitatdeldia,'host'=>$host,'calendari'=>$Calendari)
					);
				$mailclient=$clientoriginal->getMail();
				if ((!empty($mailclient)) and (empty($enviada)))
				{
					$mensaje = \Swift_Message::newInstance()
					->setSubject('Vitawork E3: Tu dosis de bienestar.')
					->setFrom('mailing@vitaworke3.com')
					->setTo('92877@parcdesalutmar.cat')
					->setBody($texto,'text/html');
					$contenedor->get('mailer')->send($mensaje);
					$enviada=new \DateTime('now');
					$Calendari->setEnviada($enviada);
				}
					

				$LlistaAssociats = $em->getRepository('ClientBundle:Client')
				->findBy(array('Associat' =>$clientoriginal));
				foreach ($LlistaAssociats as $AssociatClient) 
				{	
					$calendariAfegit = new Calendari();
					$calendariAfegit->setClient($AssociatClient);
					$calendariAfegit->setActivitat($activitatdeldia);
					$calendariAfegit->setDiaActivitat($DataEnviament);
					$em->persist($calendariAfegit);
					$em->flush();
					$texto = $contenedor->get('twig')->render('BackendBundle:Activitat:email.html.twig',
						array('usuari' => $AssociatClient,'activitat'=>$activitatdeldia,'host'=>$host,'calendari'=>$calendariAfegit));
					$mailclient=$AssociatClient->getMail();
					if (!empty($mailclient)) 
					{
						$mensaje = \Swift_Message::newInstance()
						->setSubject('Vitawork E3: Tu dosis de bienestar.')
						->setFrom('mailing@vitaworke3.com')
						->setTo('92877@parcdesalutmar.cat')
						->setBody($texto,'text/html');
						$contenedor->get('mailer')->send($mensaje);
						$enviada=new \DateTime('now');
						$calendariAfegit->setEnviada($enviada);
					}
					
								
				}
	
			}
	
		$output->writeln('fi proces  generacio de emails...');
			
	}

	
}