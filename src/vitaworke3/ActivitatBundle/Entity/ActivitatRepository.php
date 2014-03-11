<?php
			
namespace vitaworke3\ActivitatBundle\Entity;
use Doctrine\ORM\EntityRepository;
class ActivitatRepository extends EntityRepository
{

public function queryactivitats()
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM ActivitatBundle:Activitat o'); 
		return $consulta;
  
  }

  public function querytipologies()
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM ActivitatBundle:Tipologia o'); 
		return $consulta;
  
  }

  public function queryformats()
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM ActivitatBundle:Format o'); 
		return $consulta;
  
  }

public function queryactivitatsfiltre($idformador,$idcomite,$idtipologia,$idformat)
  {
	
  		
	
    $query='SELECT o FROM ActivitatBundle:Activitat o WHERE o.id>1';
	
	if (!empty($idformador)){ $query.=' AND  o.Formador=:idformador';}
    if (!empty($idcomite)){ $query.=' AND  o.Comite=:idcomite';}
	if (!empty($idtipologia)){ $query.=' AND  o.Tipologia=:idtipologia';}
    if (!empty($idformat)){ $query.=' AND  o.Format=:idformat';}
	
	$em = $this->getEntityManager();
    $consulta = $em->createQuery($query);
   
	if (!empty($idformador)){ $consulta->setParameter('idformador', $idformador);}
    if (!empty($idcomite)){$consulta->setParameter('idcomite', $idcomite);}
	if (!empty($idtipologia)){ $consulta->setParameter('idtipologia', $idtipologia);}
    if (!empty($idformat)){$consulta->setParameter('idformat', $idformat);}
	
	return $consulta;

  }

public function queryactivitatsresponsablecomite($responsable,$comite)
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM ActivitatBundle:Activitat o WHERE (o.Formador=:responsable OR o.Comite=:comite) AND o.Baixa=0'); 
		$consulta->setParameter('responsable', $responsable);
		$consulta->setParameter('comite', $comite);
		return $consulta;
  
  }
public function querycalendariactivitat($activitat)
{
		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM CalendariBundle:Calendari o WHERE o.Activitat=:activitat 	AND o.Enviada is NULL'); 
		$consulta->setParameter('activitat', $activitat);
		return $consulta;	
}


}