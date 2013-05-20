<?php

namespace vitaworke3\CalendariBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;



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
     * @ORM\Column(name="Enviar", type="boolean" ,nullable=true)
     */
    private $Enviar;

   /**
     * @var boolean
     *
     * @ORM\Column(name="Enviada", type="datetime" ,nullable=true)
     */
    private $Enviada;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Oberta",  type="datetime" ,nullable=true)
     */
    private $Oberta;

    /**
     * @var integer
     *
     * @ORM\Column(name="Valoracio", type="integer", nullable=true)
     * @Assert\Choice(choices = {1,2,3,4,5}, multiple = false)
     */
    private $Valoracio;
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="Valorada",  type="datetime" ,nullable=true)
     */
    private $Valorada;

   

    /**
     * @var integer
     *
     * @ORM\Column(name="Pregunta1", type="integer", nullable=true)
     * @Assert\Choice(choices = {1,2,3,4,5,6,7}, multiple = false)
     */
    private $Pregunta1;
   
    /**
     * @var integer
     *
     * @ORM\Column(name="Pregunta2", type="integer", nullable=true)
     * @Assert\Choice(choices = {1,2,3,4,5,6,7}, multiple = false)
     */
    private $Pregunta2;
   
    /**
     * @var integer
     *
     * @ORM\Column(name="Pregunta3", type="integer", nullable=true)
     * @Assert\Choice(choices = {1,2,3,4,5,6,7}, multiple = false)
     */
    private $Pregunta3;
   
    /**
     * @var integer
     *
     * @ORM\Column(name="Pregunta4", type="integer", nullable=true)
     * @Assert\Choice(choices = {1,2,3,4,5,6,7}, multiple = false)
     */
    private $Pregunta4;
   
    /**
     * @var integer
     *
     * @ORM\Column(name="Pregunta5", type="integer", nullable=true)
     * @Assert\Choice(choices = {1,2,3,4,5,6,7}, multiple = false)
     */
    private $Pregunta5;
   
     /**
     * @var integer
     *
     * @ORM\Column(name="Puntuacio", type="integer", nullable=true)
     */
    private $Puntuacio;
   

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

     
    public function setOberta($oberta)
    {
        $this->Oberta = $oberta;
         return $this;
    }

    /**
     * Get Oberta
     *
     */
    public function getOberta()
    {
        return $this->Oberta;
    }

   
    

    public function setValorada($valorada)
    {
        $this->Valorada = $valorada;
         return $this;
    }

    /**
     * Get Valorada
     */
    public function getValorada()
    {
        return $this->Valorada;
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
     *
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
     */
    public function setEnviada($enviada)
    {
        $this->Enviada = $enviada;
    
        return $this;
    }

   /**
     * Set Valoracio
     *
     * @param integer $valoracio
     * @return Calendari
     */
    public function setValoracio($valoracio)
    {
        $this->Valoracio = $valoracio;
    
        return $this;
    }

    /**
     * Get 
     *
     * @return integer 
     */
    public function getValoracio()
    {
        return $this->Valoracio;
    }
 
    
   /**
     * Set Pregunta1
     *
     * @param integer $pregunta1
     * @return Calendari
     */
    public function setPregunta1($pregunta1)
    {
        $this->Pregunta1 = $pregunta1;
    
        return $this;
    }

    /**
     * Get 
     *
     * @return integer 
     */
    public function getPregunta1()
    {
        return $this->Pregunta1;
    }

      /**
     * Set Pregunta1
     *
     * @param integer $pregunta2
     * @return Calendari
     */
    public function setPregunta2($pregunta2)
    {
        $this->Pregunta2 = $pregunta2;
    
        return $this;
    }

    /**
     * Get 
     *
     * @return integer 
     */
    public function getPregunta2()
    {
        return $this->Pregunta2;
    }
     /**
     * Set Pregunta3
     *
     * @param integer $pregunta3
     * @return Calendari
     */
    public function setPregunta3($pregunta3)
    {
        $this->Pregunta3 = $pregunta3;
    
        return $this;
    }

    /**
     * Get 
     *
     * @return integer 
     */
    public function getPregunta3()
    {
        return $this->Pregunta3;
    }
     /**
     * Set Pregunta4
     *
     * @param integer $pregunta4
     * @return Calendari
     */
    public function setPregunta4($pregunta4)
    {
        $this->Pregunta4 = $pregunta4;
    
        return $this;
    }

    /**
     * Get 
     *
     * @return integer 
     */
    public function getPregunta4()
    {
        return $this->Pregunta4;
    }
     /**
     * Set Pregunta5
     *
     * @param integer $pregunta5
     * @return Calendari
     */
    public function setPregunta5($pregunta5)
    {
        $this->Pregunta5 = $pregunta5;
    
        return $this;
    }

    /**
     * Get 
     *
     * @return integer 
     */
    public function getPregunta5()
    {
        return $this->Pregunta5;
    }

    

   /**
     * Set Puntuacio
     *
     * @param integer $puntuacio
     * @return Calendari
     */
  
    public function setPuntuacio($puntuacio)
    {
        $this->Puntuacio = $puntuacio;
    
        return $this;
    }

    /**
     * Get 
     *
     * @return integer 
     */
    public function getPuntuacio()
    {
        return $this->Puntuacio;
    }




}
