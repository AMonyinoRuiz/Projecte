<?php
namespace vitaworke3\ClientBundle\Listener;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
class LoginListener
{
	private $contexto, $router;
	
	public function __construct(SecurityContext $context, Router $router)
	{
		$this->contexto = $context;
		$this->router = $router;
	}
	public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
	{
		$token = $event->getAuthenticationToken();
	}
	
	public function onKernelResponse(FilterResponseEvent $event)
	{
		
		if ($this->contexto->isGranted('ROLE_CLIENT')) {
                $portada = $this->router->generate('extranet_portada');
            } else {
                $portada = $this->router->generate('extranet_login');
            }

		$event->setResponse(new RedirectResponse($portada));
		$event->stopPropagation();
	}
}