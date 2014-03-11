<?php
			
namespace vitaworke3\UsuarisBundle\Entity;
use Doctrine\ORM\EntityRepository;
class UsuariRepository extends EntityRepository
{

public function queryusuaris()
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM UsuarisBundle:Usuari o'); 
		return $consulta;
  
  }

}