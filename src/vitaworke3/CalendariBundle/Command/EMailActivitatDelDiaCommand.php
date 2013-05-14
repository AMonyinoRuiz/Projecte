<?php

namespace vitaworke3\CalendariBundle\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class EMailActivitatDelDiaCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
		->setName('email:activitat-del-dia')
		->setDefinition(array(
		new InputArgument('client', InputArgument::OPTIONAL,
		'El slug de client pel que es genera la activitat'),
		new InputOption('accion', null, InputOption::VALUE_OPTIONAL,
		'Indica si los emails nomes es generan o tambe se envían',
		'enviar'),
))
		->setDescription('Genera i envia a cada usuari la activitat diaria');
				
	}
	
	
	protected function interact(InputInterface $input, OutputInterface $output)
	{
		$output->writeln(array(
		'Benvingut al generador de emails',
		'',
		'Per continuar, has de contestar algunes preguntes...'
		));
		$dialog = $this->getHelperSet()->get('dialog');
		$client = $dialog->ask($output,
		'¿Per a quin client vols generar els emails? ',
		'danone'
		);
		$input->setArgument('client', $client);
		
		$accion = $dialog->askAndValidate($output,
		'¿Qué vols fer amb els emails? (generar o enviar) ',
		function($valor) {
			if (!in_array($valor, array('generar', 'enviar'))) {
			throw new \InvalidArgumentException(
			'La acció nomes pot ser "generar" o "enviar"'
			);
			}
		return $valor;
		});
		$input->setOption('accion', $accion);


		
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
			$output->writeln('inici proces <fg=magenta> generacio de emails</>...');
			
			$host = 'dev' == $input->getOption('env') ?
			'http://vitaworke3.local' :
			'http://vitaworke3.com';
			$accion = $input->getOption('accion');
			$associat = $input->getArgument('client');
			$contenedor = $this->getContainer();
			$em = $contenedor->get('doctrine')->getEntityManager();	
  			//$usuaris=$em->getRepository('ClientBundle:Client')
  			//->findAll();
			//$activitats = array();
			//$activitats = $em->getRepository('ActivitatBundle:Activitat')->findAll();
			$Calendari = array();
			$DataEnviament = new \DateTime('today');
			$Calendaris = $em->getRepository('CalendariBundle:Calendari')->findBy(array('DiaActivitat' => $DataEnviament));
			foreach ($Calendaris as $Calendari)
			{
				$clientoriginal=$Calendari->getClient();
				$associatclient = $clientoriginal->getAssociat();
					
						if ($associatclient==$associat)
						{
							
							$activitatdeldia=$Calendari->getActivitat();
							$texto = $this->render(
							'BackendBundle:Activitat:email.html.twig',array('usuari' => $clientoriginal,'activitat'=>$activitatdeldia,'host'=>$host,'calendari'=>$Calendari)
							);
				
							$mailclient=$clientoriginal->getMail();
							if (!empty($mailclient)) 
							{
								$mensaje = \Swift_Message::newInstance()
								->setSubject('Vitawork E3: Tu dosis de bienestar.')
								->setFrom('mailing@vitaworke3.com')
								->setTo('92877@parcdesalutmar.cat')
								->setBody($texto,'text/html');
								$contenedor->get('mailer')->send($mensaje);
				
							}	
						}

					
			}


			
			
			
			
			
			$output->writeln('fi proces  generacio de emails...');
			
	}

	
}