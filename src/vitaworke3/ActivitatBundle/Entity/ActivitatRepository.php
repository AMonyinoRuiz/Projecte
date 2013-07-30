<?php
			
namespace vitaworke3\ActivitatBundle\Entity;
use Doctrine\ORM\EntityRepository;
class ActivitatRepository extends EntityRepository
{

public function queryactivitats()
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM ActivitatBundle:Activitat o WHERE o.Baixa=0'); 
		return $consulta;
  
  }

public function queryactivitatsfiltre($formador)
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM ActivitatBundle:Activitat o WHERE o.Formador=:formador AND o.Baixa=0'); 
		$consulta->setParameter('formador', $formador);
		return $consulta;
  
  }

}