<?php

namespace vitaworke3\CalendariBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;

/**
 * Calendari
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Calendari
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DiaActivitat", type="date")
     */
    private $DiaActivitat;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100,nullable=true)
     */
    private $slug;


    /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\ClientBundle\Entity\Client") 
      */
    
   
    private $Client;

    /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\Activitat") 
      */
     
    private $Activitat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Associats", type="boolean" ,nullable=true)
     */
    private $Associats;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Realitzada", type="boolean" ,nullable=true)
     */
    private $Realitzada;

    /**
     * @var date
     *
     * @ORM\Column(name="DataRealitzada", type="date" ,nullable=true)
     */
    private $DataRealitzada;
    

    /**
     * @var boolean
     *
     * @ORM\Column(name="Enviar", type="boolean" ,nullable=true)
     */
    private $Enviar;

   /**
     * @var boolean
     *
     * @ORM\Column(name="Enviada", type="boolean" ,nullable=true)
     */
    private $Enviada;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    
  


    /**
     * Set DiaActivitat
     *
     * @param \DateTime $diaActivitat
     * @return Calendari
     */
    public function setDiaActivitat($diaActivitat)
    {
        $this->DiaActivitat = $diaActivitat;
         return $this;
    }

    /**
     * Get DiaActivitat
     *
     * @return \DateTime 
     */
    public function getDiaActivitat()
    {
        return $this->DiaActivitat;
    }

    /**
     * Set slug
     *
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

   

    /**
     * Set Client
     *
     * @param string $client
     * @return Calendari
     */
    public function setClient(\vitaworke3\ClientBundle\Entity\Client $client)
    {
        $this->Client = $client;
    
        return $this;
    }

    /**
     * Get Client
     *
     * @return string 
     */
    public function getClient()
    {
        return $this->Client;
    }

    /**
     * Set Activitat
     *
     * @param string $activitat
     * @return Calendari
     */
    public function setActivitat(\vitaworke3\ActivitatBundle\Entity\Activitat $activitat)
    {
        $this->Activitat = $activitat;
    
        return $this;
    }

    /**
     * Get Activitat
     *
     * @return string 
     */
    public function getActivitat()
    {
        return $this->Activitat;
    }

    /**
     * Set Associats
     *
     * @param boolean $associats
     * @return Calendari
     */
    public function setAssociats($associats)
    {
        $this->Associats = $associats;
    
        return $this;
    }

    /**
     * Get Associats
     *
     * @return boolean 
     */
    public function getAssociats()
    {
        return $this->Associats;
    }

     /**
     * Set Realitzada
     *
     * @param boolean $realitzada
     * @return Calendari
     */
    public function setRealitzada($realitzada)
    {
        $this->Realitzada = $realitzada;
    
        return $this;
    }

    /**
     * Get Realitzada
     *
     * @return boolean 
     */
    public function getRealitzada()
    {
        return $this->Realitzada;
    }
    
     
    public function setDataRealitzada($dataRealitzada)
    {
        $this->DataRealitzada = $dataRealitzada;
         return $this;
    }

    /**
     * Get DataRealitzada
     *
     * @return \Date
     */
    public function getDataRealitzada()
    {
        return $this->DataRealitzada;
    }



     /**
     * Set Enviar
     *
     * @param boolean $enviar
     * @return Calendari
     */
    public function setEnviar($enviar)
    {
        $this->Enviar = $enviar;
    
        return $this;
    }

       /**
     * Get Enviar
     *
     * @return boolean 
     */
    public function getEnviar()
    {
        return $this->Enviar;
    }

    /**
     * Get Enviada
     *
     * @return boolean 
     */
    public function getEnviada()
    {
        return $this->Enviada;
    }

  /**
     * Set Enviada
     *
     * @param boolean $enviada
     * @return Calendari
     */
    public function setEnviada($enviada)
    {
        $this->Enviada = $enviada;
    
        return $this;
    }

 

}
