<?php

namespace vitaworke3\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use vitaworke3\BackendBundle\Form\Extranet\ActivitatType;
use vitaworke3\ActivitatBundle\Entity\Activitat;
use vitaworke3\ActivitatBundle\Entity\Tag;
use vitaworke3\CalendariBundle\Entity\Calendari;
use vitaworke3\CalendariBundle\Entity\Planning;

use vitaworke3\BackendBundle\Form\Extranet\CalendariType;
use vitaworke3\ClientBundle\Entity\Client;
use vitaworke3\ClientBundle\Entity\ClientIdioma;
use vitaworke3\BackendBundle\Form\Extranet\CalendariValorarType;
use vitaworke3\BackendBundle\Form\Extranet\PlanningNouType;

use vitaworke3\BackendBundle\Form\Extranet\TestInicialType;
use vitaworke3\BackendBundle\Form\Extranet\ClientType;
use vitaworke3\BackendBundle\Form\Extranet\ClientIdiomaType;
use vitaworke3\BackendBundle\Form\Extranet\GrupType;
use vitaworke3\BackendBundle\Form\Extranet\EmpresaType;
use vitaworke3\BackendBundle\Form\Extranet\ComiteType;
use vitaworke3\BackendBundle\Form\Extranet\FormadorType;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Security\Core\SecurityContext;
use vitaworke3\UsuarisBundle\Form\RegistrationFormType;

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
       	$user = $this->container->get('security.context')->getToken()->getUser();
    	$rols=$user->getRoles();
		$rolAdmin=0;
		foreach ($rols as $rol)
		 {
			if ($rol=='ROLE_ADMIN')
			{	
				$rolAdmin=1;
			}
		 }
	
        return $this->render('BackendBundle:Extranet:frontend.html.twig', array('rol' => $rolAdmin));
    }

   
    




	public function PerfilAction()
    {
        return $this->render('BackendBundle:Extranet:perfil.html.twig');
    }


}