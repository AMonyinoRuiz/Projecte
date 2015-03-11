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
	WHERE o.TipusClient=:grup OR o.TipusClient=:empresa');
	$consulta->setParameter('empresa', $oferta);
	$consulta->setParameter('grup', $grup);
	
	return $consulta;
}



}