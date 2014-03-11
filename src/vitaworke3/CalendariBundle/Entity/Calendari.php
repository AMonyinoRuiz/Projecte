<?php

namespace vitaworke3\CalendariBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Calendari
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="vitaworke3\CalendariBundle\Entity\CalendariRepository")
 * 
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
     * @Assert\Choice(choices = {1,2,3,4,5,null}, multiple = false)
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
     * @ORM\Column(name="DiesCaducitat", type="integer", nullable=true)
     */
    private $DiesCaducitat;

    /**
     * @var integer
     *
     * @ORM\Column(name="Pregunta5", type="integer", nullable=true)
     * @Assert\Choice(choices = {1,2,3,4,5,6,7}, multiple = false)
     */
    //private $Pregunta5;
   
    

   /**
     * @var string
     *
     * @ORM\Column(name="assumpte", type="string", length=100,nullable=true)
     */
    private $assumpte;

     /**
     * @var string
     *
     * @ORM\Column(name="titol1", type="string", length=100,nullable=true)
     */
    private $titol1;
    
     /**
     * @var string
     *
     * @ORM\Column(name="titol2", type="string", length=100,nullable=true)
     */
    private $titol2;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="nick", type="boolean" ,nullable=true)
     */
     private $nick;

       /**
     * @var string
     *
     * @ORM\Column(name="contingut", type="string", length=100,nullable=true)
     */
    private $contingut;

      /**
     * @var boolean
     *
     * @ORM\Column(name="Baixa", type="boolean", nullable=true)
     */
    private $Baixa;

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

   /**
     * Set assumpte
     *
     * @param string $assumpte
     * @return ClientIdioma
     */
    public function setAssumpte($assumpte)
    {
        $this->assumpte = $assumpte;
    
        return $this;
    }

    /**
     * Get assumpte
     *
     * @return string 
     */
    public function getAssumpte()
    {
        return $this->assumpte;
    }


     /**
     * Set titol1
     *
     * @param string $titol1
     * @return ClientIdioma
     */
    public function setTitol1($titol1)
    {
        $this->titol1 = $titol1;
    
        return $this;
    }

    /**
     * Get titol1
     *
     * @return string 
     */
    public function getTitol1()
    {
        return $this->titol1;
    }
    
    /**
     * Set titol2
     *
     * @param string $titol2
     * @return ClientIdioma
     */
    public function setTitol2($titol2)
    {
        $this->titol2 = $titol2;
    
        return $this;
    }

    /**
     * Get titol2
     *
     * @return string 
     */
    public function getTitol2()
    {
        return $this->titol2;
    }
    
    /**
     * Set nick
     *
     * @param string $nick
     * @return ClientIdioma
     */
    public function setNick($nick)
    {
        $this->nick = $nick;
    
        return $this;
    }

    /**
     * Get nick
     *
     * @return string 
     */
    public function getNick()
    {
        return $this->nick;
    }



 /**
     * Set contingut
     *
     * @param string $contingut
     * @return ClientIdioma
     */
    public function setContingut($contingut)
    {
        $this->contingut = $contingut;
    
        return $this;
    }

    /**
     * Get contingut
     *
     * @return string 
     */
    public function getContingut()
    {
        return $this->contingut;
    }



  /**
     * Set DiesCaducitat
     *
     * @param integer $diesCaducitat
     * @return DiesCaducitat
     */
    public function setDiesCaducitat($diesCaducitat)
    {
        $this->DiesCaducitat = $diesCaducitat;
    
        return $this;
    }

    /**
     * Get 
     *
     * @return integer 
     */
    public function getDiesCaducitat()
    {
        return $this->DiesCaducitat;
    }

    /**
     * Set Baixa
     *
     * @param boolean $baixa
     * @return Baixa
     */
    public function setBaixa($baixa)
    {
        $this->Baixa = $baixa;
    
        return $this;
    }

    /**
     * Get Baixa
     *
     * @return boolean 
     */
    public function getBaixa()
    {
        return $this->Baixa;
    }

}
