<?php

namespace vitaworke3\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;
use Doctrine\Common\Collections\ArrayCollection;
 
/**
 * Client
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Client
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
     *
     * @ORM\Column(name="Nom", type="string", length=100)
     */
    private $Nom;


 /**
     * @var string
     *
     * @ORM\Column(name="Nick", type="string", length=100)
     */
    private $Nick;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;

      /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="vitaworke3\ClientBundle\Entity\TipusClient") */
     private $TipusClient;
    /**
     * @var string
     * 
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\ClientBundle\Entity\Client") 
     * @ORM\JoinColumn(nullable=true)
     *
     */

    public $Associat;

   
    /**
     * @var string
     *
     * @ORM\Column(name="DataAccesAutoritzat", type="date")
     */
    private $DataAccesAutoritzat;

    /**
     * @var string
     *
     * @ORM\Column(name="Mail", type="string", length=100)
     */
    private $Mail;

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
     * Set Nom
     *
     * @param string $nom
     * @return Client
     */
    public function setNom($nom)
    {
        $this->Nom = $nom;
        $this->slug = Util::getSlug($nom);
    
        return $this;
    }

    /**
     * Get Nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->Nom;
    }


/**
     * Set Nick
     *
     * @param string $nick
     * @return Client
     */
    public function setNick($nick)
    {
        $this->Nick = $nick;
       
        return $this;
    }

    /**
     * Get Nick
     *
     * @return string 
     */
    public function getNick()
    {
        return $this->Nick;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Client
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
     * Set TipusClient
     *
     * @param string $tipusClient
     * @return Client
     */
    public function setTipusClient(\vitaworke3\ClientBundle\Entity\TipusClient $tipusClient)
    {
        $this->TipusClient = $tipusClient;
    
        return $this;
    }

    /**
     * Get TipusClient
     *
     * @return string 
     */
    public function getTipusClient()
    {
        return $this->TipusClient;
    }

    /**
     * Set Associat
     *
     * @param mixed $associat \vitaworke3\ClientBundle\Entity\Client or NULL
     * 
     * @return Client
     */
    public function setAssociat(\vitaworke3\ClientBundle\Entity\Client $associat = null)
    {
        $this->Associat = $associat;
    
        return $this;
    }

    /**
     * Get Associat
     *
     * @return string 
     */
    public function getAssociat()
    {
        return $this->Associat;
    }

    /**
     * Set DataAccesAutoritzat
     *
     * @param string $dataAccesAutoritzat
     * @return Client
     */
    public function setDataAccesAutoritzat($dataAccesAutoritzat)
    {
        $this->DataAccesAutoritzat = $dataAccesAutoritzat;
    
        return $this;
    }

    /**
     * Get DataAccesAutoritzat
     *
     * @return string 
     */
    public function getDataAccesAutoritzat()
    {
        return $this->DataAccesAutoritzat;
    }

    /**
     * Set Mail
     *
     * @param string $mail
     * @return Client
     */
    public function setMail($mail)
    {
        $this->Mail = $mail;
    
        return $this;
    }

    /**
     * Get Mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->Mail;
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
        $var= $this->getNom();
        if ($var==null)
        {
            $var=' ';
        }

        return $var;

    }
    public function __construct()
    {
        $this->Associat = new ArrayCollection();
    }


}
