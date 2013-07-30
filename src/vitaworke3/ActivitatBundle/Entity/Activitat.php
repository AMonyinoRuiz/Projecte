<?php

namespace vitaworke3\ActivitatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;





/**
 * Activitat
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="vitaworke3\ActivitatBundle\Entity\ActivitatRepository")
 */
class Activitat
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
     * @ORM\Column(name="Activitat", type="string", length=100)
     */
    private $Activitat;

    
    /**
     * @var string
     *
     * @ORM\Column(name="TItol", type="string", length=100)
     */
    private $Titol;

    
    /**
     * @var string
     *
     * @ORM\Column(name="Subtitol", type="string", length=100)
     */
    private $Subtitol;


    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\Tipologia") 
     */
    private $Tipologia;
    

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="vitaworke3\ActivitatBundle\Entity\Tag",cascade={"persist"}) 
     */
    private $Tags;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\Format")
     */
    private $Format;

    /**
     * @var string
     *
     *@ORM\ManyToOne(targetEntity="vitaworke3\ClientBundle\Entity\Client") 
     */
    private $Comite;

    /**
     * @var string
     *
     *@ORM\ManyToOne(targetEntity="vitaworke3\ClientBundle\Entity\Client") 
     */
    private $Formador;
    
    /**
     * @var \Date
     *
     * @ORM\Column(name="DataCreacio", type="date", nullable=true)
     */
    private $DataCreacio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Baixa", type="boolean", nullable=true)
     */
    private $Baixa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Activada", type="boolean", nullable=true)
     */
    private $Activada;

    /**
     * @var integer
     *
     * @ORM\Column(name="DiesCaducitat", type="integer", nullable=true)
     */
    private $DiesCaducitat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $Text1;

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $Text2;
    
     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $Text3;
    
     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $Text4;
    
     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $Text5;
     
      /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $Text6;
     
      /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $Text7;
     
      /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $Text8;

     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\TipusCamp") 
     */
    private $TipusCamp1;
   
     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\TipusCamp") 
     */
    private $TipusCamp2;
   
    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\TipusCamp") 
     */
    private $TipusCamp3;
    
     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\TipusCamp") 
     */
    private $TipusCamp4;
    
     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\TipusCamp") 
     */
    private $TipusCamp5;
    
     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\TipusCamp") 
     */
    private $TipusCamp6;
    
      /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\TipusCamp") 
     */
    private $TipusCamp7;
   
     /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\TipusCamp") 
     */
    private $TipusCamp8;
   
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Activitat
     *
     * @param string $activitat
     * @return Activitat
     */
    public function setActivitat($activitat)
    {
        $this->Activitat = $activitat;
        $this->slug = Util::getSlug($activitat);
    
    
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
     * Set Titol
     *
     * @param string $titol
     * @return Titol
     */
    public function setTitol($titol)
    {
        $this->Titol = $titol;
      
        return $this;
    }

    /**
     * Get Titol
     *
     * @return string 
     */
    public function getTitol()
    {
        return $this->Titol;
    }

   
     /**
     * Set Subtitol
     *
     * @param string $subtitol
     * @return Subtitol
     */
    public function setSubtitol($subtitol)
    {
        $this->Subtitol = $subtitol;
      
        return $this;
    }

    
       
 
    /**
     * Get Subtitol
     *
     * @return string 
     */
    public function getSubtitol()
    {
        return $this->Subtitol;
    }
    


    /**
     * Set slug
     *
     * @param string $slug
     * @return Activitat
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
     * Set Tipologia
     *
     * @param string $tipologia
     * @return Activitat
     */
    public function setTipologia(\vitaworke3\ActivitatBundle\Entity\Tipologia $tipologia)
    {
        $this->Tipologia = $tipologia;
    
        return $this;
    }

    /**
     * Get Tipologia
     *
     * @return string 
     */
    public function getTipologia()
    {
        return $this->Tipologia;
    }

    /**
     * Set Format
     *
     * @param string $format
     * @return Activitat
     */
    public function setFormat(\vitaworke3\ActivitatBundle\Entity\Format $format)
    {
        $this->Format = $format;
    
        return $this;
    }

    /**
     * Get Format
     *
     * @return string 
     */
    public function getFormat()
    {
        return $this->Format;
    }

    /**
     * Set Comite
     *
     * @param string $comite
     * @return Activitat
     */
    public function setComite(\vitaworke3\ClientBundle\Entity\Client $comite)
    {
        $this->Comite = $comite;
    
        return $this;
    }

    /**
     * Get Comite
     *
     * @return string 
     */
    public function getComite()
    {
        return $this->Comite;
    }

    /**
     * Set Formador
     *
     * @param string $formador
     * @return Activitat
     */
    public function setFormador(\vitaworke3\ClientBundle\Entity\Client $formador)
    {
        $this->Formador = $formador;
    
        return $this;
    }

    /**
     * Get Formador
     *
     * @return string 
     */
    public function getFormador()
    {
        return $this->Formador;
    }

    /**
     * Set DataCreacio
     *
     * @param \Date $dataCreacio
     * @return Activitat
     */
    public function setDataCreacio($dataCreacio)
    {
        $this->DataCreacio = $dataCreacio;
    
        return $this;
    }

    /**
     * Get DataCreacio
     *
     * @return \Date
     */
    public function getDataCreacio()
    {
        $data=new \Date('today');
        return $this->data;
    }



    /**
     * Set Baixa
     *
     * @param boolean $baixa
     * @return Activitat
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

    /**
     * Set Activada
     *
     * @param boolean $activada
     * @return Activitat
     */
    public function setActivada($activada)
    {
        $this->Activada = $activada;
    
        return $this;
    }

    /**
     * Get Activada
     *
     * @return boolean 
     */
    public function getActivada()
    {
        return $this->Activada;
    }

    public function __toString()
    {
       
        $var= $this->getActivitat();
        if ($var==null)
        {
            $var=' ';
        }

        return $var;

    }


    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

 
    public function setText1($text1)
    {
        $this->Text1 = $text1;
      
        return $this;
    }

    /**
     * Get Text1
     *
     * @return string 
     */
    public function getText1()
    {
        return $this->Text1;
    }

     /**
     * Set Text2
     *
     * @param string $text2
     * @return Text2
     */
    public function setText2($text2)
    {
        $this->Text2 = $text2;
      
        return $this;
    }

    /**
     * Get Text2
     *
     * @return string 
     */
    public function getText2()
    {
        return $this->Text2;
    }
      /**
     * Set Text3
     *
     * @param string $text3
     * @return Text3
     */
    public function setText3($text3)
    {
        $this->Text3 = $text3;
      
        return $this;
    }

    /**
     * Get Text3
     *
     * @return string 
     */
    public function getText3()
    {
        return $this->Text3;
    }
     /**
     * Set Text4
     *
     * @param string $text4
     * @return Text4
     */
    public function setText4($text4)
    {
        $this->Text4 = $text4;
      
        return $this;
    }

    /**
     * Get Text4
     *
     * @return string 
     */
    public function getText4()
    {
        return $this->Text4;
    }
     /**
     * Set Text5
     *
     * @param string $text5
     * @return Text5
     */
    public function setText5($text5)
    {
        $this->Text5 = $text5;
      
        return $this;
    }

    /**
     * Get Text5
     *
     * @return string 
     */
    public function getText5()
    {
        return $this->Text5;
    }
     /**
     * Set Text6
     *
     * @param string $text6
     * @return Text6
     */
    public function setText6($text6)
    {
        $this->Text6 = $text6;
      
        return $this;
    }

    /**
     * Get Text6
     *
     * @return string 
     */
    public function getText6()
    {
        return $this->Text6;
    }
     /**
     * Set Text7
     *
     * @param string $text7
     * @return Text7
     */
    public function setText7($text7)
    {
        $this->Text7 = $text7;
      
        return $this;
    }

    /**
     * Get Text7
     *
     * @return string 
     */
    public function getText7()
    {
        return $this->Text7;
    }
     /**
     * Set Text8
     *
     * @param string $text8
     * @return Text8
     */
    public function setText8($text8)
    {
        $this->Text8 = $text8;
      
        return $this;
    }

    /**
     * Get Text8
     *
     * @return string 
     */
    public function getText8()
    {
        return $this->Text8;
    }
  
    /**
     * Set TipusCamp1
     *
     * @param string $tipuscamp1
     * @return TipusCamp1
     */
    public function setTipusCamp1(\vitaworke3\ActivitatBundle\Entity\TipusCamp $tipuscamp1 = null)
    {
        $this->TipusCamp1 = $tipuscamp1;
    
        return $this;
    }

    /**
     * Get TipusCamp1
     *
     * @return string 
     */
    public function getTipusCamp1()
    {
        return $this->TipusCamp1;
    }
     
     /**
     * Set TipusCamp2
     *
     * @param string $tipuscamp2
     * @return TipusCamp2
     */
    public function setTipusCamp2(\vitaworke3\ActivitatBundle\Entity\TipusCamp $tipuscamp2 = null)
    { 
        $this->TipusCamp2 = $tipuscamp2;
    
        return $this;
    }

    /**
     * Get TipusCamp2
     *
     * @return string 
     */
    public function getTipusCamp2()
    {
        return $this->TipusCamp2;
    }

     /**
     * Set TipusCamp3
     *
     * @param string $tipuscamp3
     * @return TipusCamp3
     */
    public function setTipusCamp3(\vitaworke3\ActivitatBundle\Entity\TipusCamp $tipuscamp3 = null)
    {
        $this->TipusCamp3 = $tipuscamp3;
    
        return $this;
    }

    /**
     * Get TipusCamp3
     *
     * @return string 
     */
    public function getTipusCamp3()
    {
        return $this->TipusCamp3;
    }

    /**
     * Set TipusCamp4
     *
     * @param string $tipuscamp4
     * @return TipusCamp4
     */
    public function setTipusCamp4(\vitaworke3\ActivitatBundle\Entity\TipusCamp $tipuscamp4 = null)
    {
        $this->TipusCamp4 = $tipuscamp4;
    
        return $this;
    }

    /**
     * Get TipusCamp4
     *
     * @return string 
     */
    public function getTipusCamp4()
    {
        return $this->TipusCamp4;
    }

    /**
     * Set TipusCamp5
     *
     * @param string $tipuscamp5
     * @return TipusCamp5
     */
    public function setTipusCamp5(\vitaworke3\ActivitatBundle\Entity\TipusCamp $tipuscamp5 = null)
    {
        $this->TipusCamp5 = $tipuscamp5;
    
        return $this;
    }

    /**
     * Get TipusCamp5
     *
     * @return string 
     */
    public function getTipusCamp5()
    {
        return $this->TipusCamp5;
    }
    /**
     * Set TipusCamp6
     *
     * @param string $tipuscamp6
     * @return TipusCamp6
     */
    public function setTipusCamp6(\vitaworke3\ActivitatBundle\Entity\TipusCamp $tipuscamp6 = null)
    {
        $this->TipusCamp6 = $tipuscamp6;
    
        return $this;
    }

    /**
     * Get TipusCamp6
     *
     * @return string 
     */
    public function getTipusCamp6()
    {
        return $this->TipusCamp6;
    }

    /**
     * Set TipusCamp7
     *
     * @param string $tipuscamp7
     * @return TipusCamp7
     */
    public function setTipusCamp7(\vitaworke3\ActivitatBundle\Entity\TipusCamp $tipuscamp7 = null)
    {
        $this->TipusCamp7 = $tipuscamp7;
    
        return $this;
    }

    /**
     * Get TipusCamp7
     *
     * @return string 
     */
    public function getTipusCamp7()
    {
        return $this->TipusCamp7;
    }

    /**
     * Set TipusCamp8
     *
     * @param string $tipuscamp8
     * @return TipusCamp8
     */
    public function setTipusCamp8(\vitaworke3\ActivitatBundle\Entity\TipusCamp $tipuscamp8 = null)
    {
        $this->TipusCamp8 = $tipuscamp8;
    
        return $this;
    }

    /**
     * Get TipusCamp8
     *
     * @return string 
     */
    public function getTipusCamp8()
    {
        return $this->TipusCamp8;
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




  
}
