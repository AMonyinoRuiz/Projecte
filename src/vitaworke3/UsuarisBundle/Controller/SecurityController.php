<?php
 
namespace vitaworke3\UsuarisBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
 
class SecurityController extends Controller
{
    public function loginAction()
    {
        $helper = $this->get('security.authentication_utils');


        return $this->render('UsuarisBundle:Security:login.html.twig', array(
        'last_username' => $helper->getLastUsername(),
        'error'         => $helper->getLastAuthenticationError(),
        ));
    }

    public function getTokenAction()
    {
        return new Response($this->container->get('form.csrf_provider')
            ->generateCsrfToken('authenticate'));
    }
    public function logoutAction()
    {
         $this->get('security.authorization_checker')->setToken(null);
        $this->get('request')->getSession()->invalidate();
        return $this->redirect($this->generateUrl('extranet_portada'));
    }

}