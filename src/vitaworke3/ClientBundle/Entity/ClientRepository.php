<?php
			
namespace vitaworke3\ClientBundle\Entity;
use Doctrine\ORM\EntityRepository;
class ClientRepository extends EntityRepository
{

  public function querygrupempresa($grup,$empresa)
  {
	
	$em = $this->getEntityManager();
	$consulta = $em->createQuery('
	SELECT o FROM ClientBundle:Client o
	WHERE o.TipusClient=:grup OR o.TipusClient=:empresa AND o.Baixa=0');
	$consulta->setParameter('empresa', $empresa);
	$consulta->setParameter('grup', $grup);
	return $consulta;
  
  }
public function querygrupempresaeditar($grup,$empresa,$id)
  {
	
	$em = $this->getEntityManager();
	$consulta = $em->createQuery('
	SELECT o FROM ClientBundle:Client o
	WHERE o.id!=:id AND (o.TipusClient=:grup OR o.TipusClient=:empresa ) AND o.Baixa=0 ');
	$consulta->setParameter('empresa', $empresa);
	$consulta->setParameter('grup', $grup);
	$consulta->setParameter('id', $id);
	return $consulta;
  
  }


 public function queryclientsfiltre($tipusclient,$idassociat)
  {
	
	$em = $this->getEntityManager();
	$consulta = $em->createQuery('
	SELECT o FROM ClientBundle:Client o
	WHERE o.TipusClient=:tipusclient AND  o.Associat=:idassociat AND o.Baixa=0');
	$consulta->setParameter('tipusclient', $tipusclient);
	$consulta->setParameter('idassociat', $idassociat);
	
	return $consulta;
  
  }

 public function queryclients($tipusclient)
  {
	
	$em = $this->getEntityManager();
	$consulta = $em->createQuery('
	SELECT o FROM ClientBundle:Client o
	WHERE o.TipusClient=:tipusclient AND o.Baixa=0');
	$consulta->setParameter('tipusclient', $tipusclient);
	return $consulta;
  
  }
 public function queryidiomas()
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM BackendBundle:Idioma o WHERE o.Baixa=0'); 
		return $consulta;
  
  }

  public function querytemplates($grupempresa)
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM ClientBundle:ClientIdioma o WHERE o.Client=:grupempresa AND o.Baixa=0'); 
		$consulta->setParameter('grupempresa', $grupempresa);
		return $consulta;
  
  }

  public function queryclientidioma()
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM ClientBundle:ClientIdioma o AND o.Baixa=0'); 
		return $consulta;
  
  }
}