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
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="vitaworke3\ActivitatBundle\Entity\ActivitatRepository")
 * 
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
     * @ORM\Column(name="Titol", type="string", length=100)
     */
    private $Titol;

    
    /**
     * @var string
     *
     * @ORM\Column(name="Subtitol", type="string", length=100 , nullable=true)
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
     * @ORM\ManyToOne(targetEntity="vitaworke3\ActivitatBundle\Entity\Format")
     */
    private $Format;

    /**
     * @var string
     *
     *@ORM\ManyToMany(targetEntity="vitaworke3\ClientBundle\Entity\Client") 
     */
    private $Responsable;

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
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    public $Text1;

     /**
     * @ORM\Column(type="string", length=1000, nullable=true)
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
     * @ORM\Column(name="contingut", type="string", length=1000,nullable=true)
     */
    private $contingut;

    /**
     * @ORM\Column(name="path",type="string", length=255, nullable=true)
     */
    public $path;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    /**
     * @ORM\Column(name="path2",type="string", length=255, nullable=true)
     */
    public $path2;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    public $file2;

     /**
     * @ORM\Column(name="path3",type="string", length=255, nullable=true)
     */
    public $path3;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    public $file3;
     /**
     * @ORM\Column(name="path4",type="string", length=255, nullable=true)
     */
    public $path4;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    public $file4;

 /**
     * @ORM\Column(name="path5",type="string", length=255, nullable=true)
     */
    public $path5;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    public $file5;

 /**
     * @ORM\Column(name="path6",type="string", length=255, nullable=true)
     */
    public $path6;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    public $file6;

 /**
     * @ORM\Column(name="path7",type="string", length=255, nullable=true)
     */
    public $path7;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    public $file7;

 /**
     * @ORM\Column(name="path8",type="string", length=255, nullable=true)
     */
    public $path8;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    public $file8;


     public function __construct()
    {
        $this->Responsable = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /*
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
     * @return Slug
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
     * @return tipologia
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
     * @return Format
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
     * Set responsable
     *
     * @param mixed comite \vitaworke3\ClientBundle\Entity\Client or NULL
     * @return Comite
     */
    public function addResponsable(\vitaworke3\ClientBundle\Entity\Client $responsable= null)
    {
        $this->responsable[]  = $responsable;
    
        return $this;
    }

    /**
     * Get responsable
     *
     * @return Doctrine\Common\Collections\Collection responsable
     */
    public function getResponsable()
    {
        return $this->Responsable;
    }

    /**
     * Set DataCreacio
     *
     * @param \Date $dataCreacio
     * @return DataCreacio
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

    /**
     * Set Activada
     *
     * @param boolean $activada
     * @return Activitada
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
     * Sets file.
     *
     * @param UploadedFile $file
     */
     public function setFile(UploadedFile $file = null)
     {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
     }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
  public function setPath($path)
  {
        $this->path = $path;
        return $this;
  }
    public function getPath()
    {
        return $this->path;
    }
   public function setFile2(UploadedFile $file2 = null)
    {
        $this->file2 = $file2;
        if (isset($this->path2)) {
            $this->temp2 = $this->path2;
            $this->path2 = null;
        } else {
            $this->path2 = 'initial';
        }
     }
    public function getFile2()
    {
        return $this->file2;
    }
    public function setPath2($path2)
    {
        $this->path2 = $path2;
        return $this;
    }
    public function getPath2()
    {
        return $this->path2;
    }
    
    public function setFile3(UploadedFile $file3 = null)
    {
        $this->file3 = $file3;
        if (isset($this->path3)) {
            $this->temp3 = $this->path3;
            $this->path3 = null;
        } else {
            $this->path3 = 'initial';
        }
     }
    public function getFile3()
    {
        return $this->file3;
    }
    public function setPath3($path3)
    {
        $this->path3 = $path3;
        return $this;
    }
    public function getPath3()
    {
        return $this->path3;
    }
  public function setFile4(UploadedFile $file4 = null)
    {
        $this->file4 = $file4;
        if (isset($this->path4)) {
            $this->temp4 = $this->path4;
            $this->path4 = null;
        } else {
            $this->path4 = 'initial';
        }
     }
    public function getFile4()
    {
        return $this->file4;
    }
    public function setPath4($path4)
    {
        $this->path4 = $path4;
        return $this;
    }
    public function getPath4()
    {
        return $this->path4;
    }
    public function setFile5(UploadedFile $file5 = null)
    {
        $this->file5 = $file5;
        if (isset($this->path5)) {
            $this->temp5 = $this->path5;
            $this->path5 = null;
        } else {
            $this->path5 = 'initial';
        }
     }
    public function getFile5()
    {
        return $this->file5;
    }
    public function setPath5($path5)
    {
        $this->path5 = $path5;
        return $this;
    }
    public function getPath5()
    {
        return $this->path5;
    }
    public function setFile6(UploadedFile $file6 = null)
    {
        $this->file6 = $file6;
        if (isset($this->path6)) {
            $this->temp6 = $this->path6;
            $this->path6 = null;
        } else {
            $this->path6 = 'initial';
        }
     }
    public function getFile6()
    {
        return $this->file6;
    }
    public function setPath6($path6)
    {
        $this->path6 = $path6;
        return $this;
    }
    public function getPath6()
    {
        return $this->path6;
    }
    public function setFile7(UploadedFile $file7 = null)
    {
        $this->file7 = $file7;
        if (isset($this->path7)) {
            $this->temp7 = $this->path7;
            $this->path7 = null;
        } else {
            $this->path7 = 'initial';
        }
     }
    public function getFile7()
    {
        return $this->file7;
    }
    public function setPath7($path7)
    {
        $this->path7 = $path7;
        return $this;
    }
    public function getPath7()
    {
        return $this->path7;
    }
    public function setFile8(UploadedFile $file8 = null)
    {
        $this->file8= $file8;
        if (isset($this->path8)) {
            $this->temp8 = $this->path8;
            $this->path8 = null;
        } else {
            $this->path8 = 'initial';
        }
     }
    public function getFile8()
    {
        return $this->file8;
    }
    public function setPath8($path8)
    {
        $this->path8 = $path8;
        return $this;
    }
    public function getPath8()
    {
        return $this->path8;
    }
 public function __toString()
    {
        

        return $this->getActivitat();

    }
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/imatges';
    }
    
     /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) 
        {
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
        if (null !== $this->getFile2())
        {
            $filename2 = sha1(uniqid(mt_rand(), true));
            $this->path2 = $filename2.'.'.$this->getFile2()->guessExtension();
        }
        if (null !== $this->getFile3()) 
        {
            $filename3 = sha1(uniqid(mt_rand(), true));
            $this->path3 = $filename3.'.'.$this->getFile3()->guessExtension();
        }
        if (null !== $this->getFile4()) 
        {
            $filename4 = sha1(uniqid(mt_rand(), true));
            $this->path4 = $filename4.'.'.$this->getFile4()->guessExtension();
        }
        if (null !== $this->getFile5()) 
        {
            $filename5 = sha1(uniqid(mt_rand(), true));
            $this->path5 = $filename5.'.'.$this->getFile5()->guessExtension();
        }
        if (null !== $this->getFile6()) 
        {
            $filename6 = sha1(uniqid(mt_rand(), true));
            $this->path6 = $filename6.'.'.$this->getFile6()->guessExtension();
        }
        if (null !== $this->getFile7()) 
        {
            $filename7 = sha1(uniqid(mt_rand(), true));
            $this->path7 = $filename7.'.'.$this->getFile7()->guessExtension();
        }
        if (null !== $this->getFile8()) 
        {
            $filename8 = sha1(uniqid(mt_rand(), true));
            $this->path8 = $filename8.'.'.$this->getFile8()->guessExtension();
        }
    }
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
   
    public function upload()
    {
       
        if (null !== $this->getFile()) 
        {
            $this->getFile()->move($this->getUploadRootDir(), $this->path);

            if (isset($this->temp)) {
            // delete the old image
            //unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
                $this->temp = null;
            }
            $this->file = null;
        }
        if (null !== $this->getFile2()) 
        {
            $this->getFile2()->move($this->getUploadRootDir(), $this->path2);

            if (isset($this->temp2)) {
            $this->temp2 = null;
            }
            $this->file2 = null;
        }
        if (null !== $this->getFile3()) 
        {
            $this->getFile3()->move($this->getUploadRootDir(), $this->path3);

            if (isset($this->temp3)) {
            $this->temp3 = null;
            }
            $this->file3 = null;
        }
        if (null !== $this->getFile4()) 
        {
            $this->getFile4()->move($this->getUploadRootDir(), $this->path4);

            if (isset($this->temp4)) {
            $this->temp4 = null;
            }
            $this->file4 = null;
        }
        if (null !== $this->getFile5()) 
        {
            $this->getFile5()->move($this->getUploadRootDir(), $this->path5);

            if (isset($this->temp5)) {
            $this->temp5 = null;
            }
            $this->file5 = null;
        }
        if (null !== $this->getFile6()) 
        {
            $this->getFile6()->move($this->getUploadRootDir(), $this->path6);

            if (isset($this->temp6)) {
            $this->temp6 = null;
            }
            $this->file6 = null;
        }
        if (null !== $this->getFile7()) 
        {
            $this->getFile7()->move($this->getUploadRootDir(), $this->path7);

            if (isset($this->temp7)) {
            $this->temp7 = null;
            }
            $this->file7 = null;
        }
        if (null !== $this->getFile8()) 
        {
            $this->getFile8()->move($this->getUploadRootDir(), $this->path8);

            if (isset($this->temp8)) {
            $this->temp8 = null;
            }
            $this->file8 = null;
        }
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file == $this->getAbsolutePath()) {
           //unlink($file);
        }
    }

 
  

  
}
