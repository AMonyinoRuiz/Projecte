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

public function querygrupempresaclient($grup,$empresa,$client)
  {
	
	$em = $this->getEntityManager();
	$consulta = $em->createQuery('
	SELECT o FROM ClientBundle:Client o
	WHERE o.TipusClient=:grup OR o.TipusClient=:empresa OR o.TipusClient=:client');
	$consulta->setParameter('empresa', $empresa);
	$consulta->setParameter('grup', $grup);
$consulta->setParameter('client', $client);
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

public function queryplanningresponsable($grup,$empresa,$responsable)
  {
	
	$em = $this->getEntityManager();
	$consulta = $em->createQuery('
	SELECT o FROM ClientBundle:Client o
	WHERE o.Responsable=:responsable AND (o.TipusClient=:grup OR o.TipusClient=:empresa ) AND o.Baixa=0 ');
	$consulta->setParameter('empresa', $empresa);
	$consulta->setParameter('grup', $grup);
	$consulta->setParameter('responsable', $responsable);
	return $consulta;
  
  }

 public function queryclientsfiltre($tipusclient,$idassociat,$ididioma,$idtemplate,$idresponsable)
  {
	
    $query='SELECT o FROM ClientBundle:Client o WHERE o.TipusClient=:tipusclient';
	
	if (!empty($idassociat)){ $query.=' AND  o.Associat=:idassociat';}
    if (!empty($ididioma)){ $query.=' AND  o.Idioma=:ididioma';}
	if (!empty($idtemplate)){ $query.=' AND  o.Template=:idtemplate';}
    if (!empty($idresponsable)){ $query.=' AND  o.Responsable=:idresponsable';}
	
	$em = $this->getEntityManager();
    $consulta = $em->createQuery($query);
    $consulta->setParameter('tipusclient', $tipusclient);
	
	if (!empty($idassociat)){ $consulta->setParameter('idassociat', $idassociat);}
    if (!empty($ididioma)){$consulta->setParameter('ididioma', $ididioma);}
	if (!empty($idtemplate)){ $consulta->setParameter('idtemplate', $idtemplate);}
    if (!empty($idresponsable)){$consulta->setParameter('idresponsable', $idresponsable);}
	
	return $consulta;
  
  }

 public function queryclients($tipusclient)
  {
	
	$em = $this->getEntityManager();
	$consulta = $em->createQuery('
	SELECT o FROM ClientBundle:Client o
	WHERE o.TipusClient=:tipusclient');
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
		SELECT o FROM ClientBundle:Template o WHERE o.Client=:grupempresa'); 
		$consulta->setParameter('grupempresa', $grupempresa);
		return $consulta;
  
  }
  public function querytemplatesall()
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM ClientBundle:Template o'); 
		return $consulta;
  
  }
  
public function querytemplatesfiltre($idassociat,$ididioma)
  {
		
	 $query='SELECT o FROM ClientBundle:Template o';
	
	if (!empty($idassociat) ){$query.=' WHERE  o.Client=:idassociat';}
    if (!empty($ididioma))
    {
    	if (empty($idassociat))
    	{
     		$query.=' WHERE  o.Idioma=:ididioma';
     	}else
     	{
     		$query.=' AND  o.Idioma=:ididioma';
     	}
 	}
	
	$em = $this->getEntityManager();
    $consulta = $em->createQuery($query);
    
	if (!empty($idassociat)){ $consulta->setParameter('idassociat', $idassociat);}
    if (!empty($ididioma)){$consulta->setParameter('ididioma', $ididioma);}
	
	return $consulta;
  
  }


  public function queryclientidioma()
  {
	
  		$em = $this->getEntityManager();
		$consulta = $em->createQuery('
		SELECT o FROM ClientBundle:Template o'); 
		return $consulta;
  
  }
}