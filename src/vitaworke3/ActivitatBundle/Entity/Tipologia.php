<?php

namespace vitaworke3\ActivitatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;

/**
 * Tipologia
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tipologia
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
     * @ORM\Column(name="Tipologia", type="string", length=100)
     */
    private $Tipologia;

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
     * Set Tipologia
     *
     * @param string $tipologia
     * @return Tipologia
     */
    public function setTipologia($tipologia)
    {
        $this->Tipologia = $tipologia;
        $this->slug = Util::getSlug($tipologia);
    
    
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
     * Set slug
     *
     * @param string $slug
     * @return Tipologia
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
        $var= $this->getTipologia();
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
     * @return Tipologia
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
