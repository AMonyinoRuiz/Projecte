<?php

namespace vitaworke3\UsuarisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UsuarisBundle:Default:index.html.twig', array('name' => $name));
    }
}
