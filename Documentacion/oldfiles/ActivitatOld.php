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
 * @ORM\Entity
 */
class ActivitatOld
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
     * @ORM\Column(name="Sinopsi", type="string", length=100)
     */
    private $Sinopsi;


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
     *
    * @ORM\Column(type="string", nullable=true)
    *
    * @Assert\File()
    */
    private $Video;

    /**
    *
    * @ORM\Column(type="string", nullable=true)
    *
    * @Assert\File()
     */
    private $Audio;

    /**
     * @var \Date
     *
     * @ORM\Column(name="DataCreacio", type="date", nullable=true)
     */
    private $DataCreacio;

    /**
     * @var string
     *
     * @ORM\Column(name="Presentacio", type="text", nullable=true)
     */
    private $Presentacio;

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
     * @var string
     *
     * @ORM\Column(name="Link", type="string", nullable=true)
     */
    private $Link;


     /**
     * @var integer
     *
     * @ORM\Column(name="Html", type="string", nullable=true)
     */
    private $Html;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $pathImatge;

 
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $pathMultimedia;

   
    /**
    * 
    * @Assert\file(maxSize = "100000k")
    */
    private $multimedia;

   
   /**
     * Sets multimedia.
     *
     * @param UploadedFile $multimedia
     */
   
    public function setMultimedia(UploadedFile $multimedia = null)
    {
        $this->multimedia = $multimedia;
    }

    /**
     * Get imatge.
     *
     * @return UploadedFile
     */
    public function getMultimedia()
    {
        return $this->multimedia;
    }

    public function getAbsolutePathMultimedia()
    {
        return null === $this->pathMultimedia
            ? null
            : $this->getUploadRootDirMultimedia().'/'.$this->pathMultimedia;
    }

    public function getWebPathMultimedia()
    {
        return null === $this->pathMultimedia
            ? null
            : $this->getUploadDirMultimedia().'/'.$this->pathMultimedia;
    }

    protected function getUploadRootDirMultimedia()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDirMultimedia();
    }

    protected function getUploadDirMultimedia()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/multimedia';
    }

    public function uploadMultimedia()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getMultimedia()) {
         return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getMultimedia()->move(
        $this->getUploadRootDirMultimedia(),
        $this->getMultimedia()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->pathMultimedia = $this->getMultimedia()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->multimedia= null;
    }

/**
    * 
    * @Assert\Image(maxSize = "1500k")
    */
    private $imatge;

    /**
     * Sets imatge.
     *
     * @param UploadedFile $imatge
     */
    public function setImatge(UploadedFile $imatge = null)
    {
        $this->imatge = $imatge;
    }

    /**
     * Get imatge.
     *
     * @return UploadedFile
     */
    public function getImatge()
    {
        return $this->imatge;
    }

    public function getAbsolutePathImatge()
    {
        return null === $this->pathImatge
            ? null
            : $this->getUploadRootDirImatge().'/'.$this->pathImatge;
    }

    public function getWebPathImatge()
    {
        return null === $this->pathImatge
            ? null
            : $this->getUploadDirImatge().'/'.$this->pathImatge;
    }

    protected function getUploadRootDirImatge()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDirImatge();
    }

    protected function getUploadDirImatge()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/imatges';
    }

    public function uploadImatge()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getImatge()) {
         return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getImatge()->move(
        $this->getUploadRootDirImatge(),
        $this->getImatge()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->pathImatge = $this->getImatge()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->imatge = null;
    }












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
     * Set Sinopsi
     *
     * @param string $sinopsi
     * @return Sinopsi
     */
    public function setSinopsi($sinopsi)
    {
        $this->Sinopsi = $sinopsi;
      
        return $this;
    }

    /**
     * Get Sinopsi
     *
     * @return string 
     */
    public function getSinopsi()
    {
        return $this->Sinopsi;
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
     * Set Video
     *
     * @param string $video
     * @return Activitat
     */
    public function setVideo($video)
    {
        $this->Video = $video;
    
        return $this;
    }

    /**
     * Get Video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->Video;
    }

    /**
     * Set Audio
     *
     * @param string $audio
     * @return Activitat
     */
    public function setAudio($audio)
    {
        $this->Audio = $audio;
    
        return $this;
    }

    /**
     * Get Audio
     *
     * @return string 
     */
    public function getAudio()
    {
        return $this->Audio;
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
     * Set Presentacio
     *
     * @param string $presentacio
     * @return Activitat
     */
    public function setPresentacio($presentacio)
    {
        $this->Presentacio = $presentacio;
    
        return $this;
    }

    /**
     * Get Presentacio
     *
     * @return string 
     */
    public function getPresentacio()
    {
        return $this->Presentacio;
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

    public function UploadArxius($directoriDesti)
    {
        if (null === $this->imatge) 
        {
            return;
        }
        
        $nomArxiuimatge =$this->imatge->getClientOriginalName();
        $this->imatge->getPath();
        $this->imatge->move($directoriDesti, $nomArxiuimatge);
    }

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

 
    public function getTags()
    {
        return $this->Tags;
    }

     public function addTag(ArrayCollection $tags)
    {
        $this->tags=$tags;
    }

    public function removeTag($tag)
    {
        $this->tags->removeElement($tag);
    
    }
      /**
     * Set Link
     *
     * @param string $link
     * @return Link
     */
    public function setLink($link)
    {
        $this->Link = $link;
      
        return $this;
    }

    /**
     * Get Sinopsi
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->Link;
    }

  /**
     * Set Html
     *
     * @param string $html
     * @return Html
     */
    public function setHtml($html)
    {
        $this->Html = $html;
      
        return $this;
    }

    /**
     * Get Sinopsi
     *
     * @return string 
     */
    public function getHtml()
    {
        return $this->Sinopsi;
    }

 
  
}

