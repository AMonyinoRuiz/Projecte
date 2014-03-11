<?php

namespace vitaworke3\ActivitatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;


/**
 * Format
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Format
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
     * @ORM\Column(name="format", type="string", length=100)
     */
    private $format;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;

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
     * Set format
     *
     * @param string $format
     * @return Format
     */
    public function setFormat($format)
    {
        $this->format = $format;
        $this->slug = Util::getSlug($format);
    
    
        return $this;
    }

    /**
     * Get format
     *
     * @return string 
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Format
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



    public function __toString()
    {
        $var= $this->getFormat();
        if ($var==null)
        {
            $var=' ';
        }

        return $var;

    }
  
   
     /**
     * Set Baixa
     *
     * @param boolean $baixa
     * @return Format
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
