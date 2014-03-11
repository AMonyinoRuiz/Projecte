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
			//$host ='http://vitawork.vitaworke3.com' ;
			$contenedor = $this->getContainer();
			$em = $contenedor->get('doctrine')->getEntityManager();	
			$calendari = array();
			$DataEnviament = new \DateTime('today');
			$calendaris = $em->getRepository('CalendariBundle:Calendari')->findBy(array('DiaActivitat' => $DataEnviament));
			foreach ($calendaris as $calendari)
			{
				$clientoriginal=$calendari->getClient();
				$activitatdeldia=$calendari->getActivitat();
				$activada=$activitatdeldia->getActivada();
				$calendaribaixa=$calendari->getBaixa();
				$baixa=$activitatdeldia->getBaixa();
				$enviada=$calendari->getEnviada();
				if ($activada<>0 and $baixa<>1 and $calendaribaixa<>1)
				{
					$enviament = $em->getRepository('CalendariBundle:Calendari')->enviarmail($calendari,'mail',$contenedor,$DataEnviament);
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
					
        			$LlistaAssociats = $em->getRepository('ClientBundle:Client')->queryclientsfiltre($tipusclient,$client,'','','')->getResult();
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
						$enviament = $em->getRepository('CalendariBundle:Calendari')->enviarmail($calendariAfegit,'mail',$contenedor,$DataEnviament);
						$em->persist($calendariAfegit);
						$em->flush();
					}
				}
			}
	
		$output->writeln('fi proces  generacio de emails...');
			
	}

	
}