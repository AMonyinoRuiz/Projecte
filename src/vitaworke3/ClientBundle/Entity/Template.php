<?php

namespace vitaworke3\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Template
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Template
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
     * @var string
     * @ORM\ManyToOne(targetEntity="vitaworke3\ClientBundle\Entity\Client") 
    */
    
   
    private $Client;

  
   /**
     * @var string
     * @ORM\ManyToOne(targetEntity="vitaworke3\BackendBundle\Entity\Idioma") 
    */
    
   
    private $Idioma;

  
     /**
     * @var string
     *
     * @ORM\Column(name="nomtemplate", type="string", length=100)
     */
    private $nomtemplate;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;


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
     * Set Client
     *
     * @param string $client
     * @return Template
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
    }/**
     * Set Idioma
     *
     * @param string $idioma
     * @return Template
     */
    public function setIdioma(\vitaworke3\BackendBundle\Entity\Idioma $idioma)
    {
        $this->Idioma = $idioma;
    
        return $this;
    }

    /**
     * Get Idioma
     *
     * @return string 
     */
    public function getIdioma()
    {
        return $this->Idioma;
    }

    

     /**
     * Set assumpte
     *
     * @param string $assumpte
     * @return Template
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
     * @return Template
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
     * @return Template
     */
    public function setTitol2($titol2)
    {
        $this->titol1 = $titol2;
    
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
     * @return Template
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
     * @return Template
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
     * Set nomtemplate
     *
     */
    public function setNomtemplate($nomtemplate)
    {
        $this->nomtemplate = $nomtemplate;
        $this->slug = Util::getSlug($nomtemplate);
    
        return $this;
    }

    /**
     * Get nomtemplate
     *
     * @return string 
     */
    public function getNomtemplate()
    {
        return $this->nomtemplate;
    }
   
   /**
     * Set Baixa
     *
     * @param boolean $baixa
     * @return Client
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
    
   public function __toString()
    {
        $var= $this->getNomtemplate();
        if ($var==null)
        {
            $var=' ';
        }

        return $var;

    }
  

}
