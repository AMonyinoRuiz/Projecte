<?php

namespace vitaworke3\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
 
/**
 * Client
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="vitaworke3\ClientBundle\Entity\ClientRepository")
 */
class Client implements UserInterface
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
    * @ORM\ManyToMany(targetEntity="vitaworke3\ClientBundle\Entity\Client")
    **/

    private $Associat;

    
    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=100)
     */
    private $Nom;


 /**
     * @var string
     *
     * @ORM\Column(name="Nick", type="string", length=100,nullable=true)
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
     * @ORM\Column(name="DataAccesAutoritzatInici", type="date",nullable=true)
     */
    private $DataAccesAutoritzatInici;

    /**
     * @var string
     *
     * @ORM\Column(name="DataAccesAutoritzatFi", type="date",nullable=true)
     */
    private $DataAccesAutoritzatFi;


    /**
     * @var string
     *
     * @ORM\Column(name="Mail", type="string", length=100, nullable=true)
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

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @Assert\Length(min = 6)
     */
     private $password;

      /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @Assert\Length(min = 6)
     */
     private $salt;

     /**
     * @var string
     * @ORM\ManyToOne(targetEntity="vitaworke3\BackendBundle\Entity\Idioma") 
    */
    
   
    private $Idioma;

     /**
     * @var string
     * @ORM\ManyToOne(targetEntity="vitaworke3\ClientBundle\Entity\Template") 
    */
    
   
    private $Template;

    /**
     * @ORM\ManyToMany(targetEntity="vitaworke3\ClientBundle\Entity\Client")
     * @ORM\JoinTable(name="responsables",
     * joinColumns={@ORM\JoinColumn(name="client_id", referencedColumnName="id")},
     * inverseJoinColumns={@ORM\JoinColumn(name="responsable_id", referencedColumnName="id")}
     *      )
     */

    public $Responsable;


    public function __construct()
    {
        $this->Associat = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Responsable = new \Doctrine\Common\Collections\ArrayCollection();
    }
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
    public function setTipusClient(\vitaworke3\ClientBundle\Entity\TipusClient $tipusClient= null)
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
     * Add associat
     *
     * @param mixed associat \vitaworke3\ClientBundle\Entity\Client or NULL
     * 
     * @return Client
     */
    public function addAssociat(\vitaworke3\ClientBundle\Entity\Client $associat= null)
    {
        $this->associat[] = $associat;
    
        return $this;
    }

    /**
     * Get Associat
     *
     * @return Doctrine\Common\Collections\Collection Associat
     */
    public function getAssociat()
    {
        return $this->Associat;
    }


 
    /**
     * Set DataAccesAutoritzatInici
     *
     * @param string $dataAccesAutoritzatInici
     * @return Client
     */
    public function setDataAccesAutoritzatInici($dataAccesAutoritzatInici)
    {
        $this->DataAccesAutoritzatInici = $dataAccesAutoritzatInici;
    
        return $this;
    }

    
    /**
     * Get DataAccesAutoritzatInici
     *
     * @return string 
     */
    public function getDataAccesAutoritzatInici()
    {
        return $this->DataAccesAutoritzatInici;
    }

    

    /**
     * Set DataAccesAutoritzatFi
     *
     * @param string $dataAccesAutoritzatFi
     * @return Client
     */
    public function setDataAccesAutoritzatFi($dataAccesAutoritzatFi)
    {
        $this->DataAccesAutoritzatFi = $dataAccesAutoritzatFi;
    
        return $this;
    }
    /**
     * Get DataAccesAutoritzatFi
     *
     * @return string 
     */
    public function getDataAccesAutoritzatFi()
    {
        return $this->DataAccesAutoritzatFi;
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
   
    function eraseCredentials()
    {
    }
    
    function getRoles()
    {
        return array('ROLE_CLIENT');
    }

    function getUsername()
    {
        return $this->getNick();
    }

     public function setPassword($password)
    {
        $this->Password = $password;
    
        return $this;
    }

    function getPassword()
    {
        return $this->Password;
    }

    
    public function setSalt($salt)
    {
        $this->Salt= $salt;
        return $this;
    }

    function getSalt()
    {
         return $this->Salt;
    }


     /* Set Idioma
     *
     * @param string $idioma
     * @return Client
     */
    public function setIdioma(\vitaworke3\BackendBundle\Entity\Idioma $idioma = null)
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

    /* Set template
     *
     * @param string $template
     * @return Client
     */
    public function setTemplate(\vitaworke3\ClientBundle\Entity\Template $template = null)
    {
        $this->Template = $template;
    
        return $this;
    }

    /**
     * Get template
     *
     * @return string 
     */
    public function getTemplate()
    {
        return $this->Template;
    }
    
    /**
     * Add Responsable
     *
     * @param mixed $responsable \vitaworke3\ClientBundle\Entity\Client or NULL
     * 
     * @return Client
     */
    public function addResponsable(\vitaworke3\ClientBundle\Entity\Client $responsable= null)
    {
        $this->Responsable[] = $responsable;
        return $this;
    }

    /**
     * Get Responsable
     *
     * @return Doctrine\Common\Collections\Collection Responsable
     */
    public function getResponsable()
    {
        return $this->Responsable;
    }

}
