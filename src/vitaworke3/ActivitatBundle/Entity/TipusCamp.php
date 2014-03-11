<?php

namespace vitaworke3\ActivitatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;

/**
 * TipusCamp
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TipusCamp
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
     * @ORM\Column(name="TipusCamp", type="string", length=100)
     */
    private $TipusCamp;

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
     * Set TipusCamp
     *
     * @param string $tipuscamp
     * @return TipusCamp
     */
    public function setTipusCamp($tipuscamp)
    {
        $this->TipusCamp = $tipuscamp;
        $this->slug = Util::getSlug($tipuscamp);
    
    
        return $this;
    }

    /**
     * Get TipusCamp
     *
     * @return string 
     */
    public function getTipusCamp()
    {
        return $this->TipusCamp;
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
    
    

  public function __toString()
    {
        $var= $this->getTipusCamp();
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
