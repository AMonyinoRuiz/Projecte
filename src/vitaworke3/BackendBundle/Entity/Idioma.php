<?php

namespace vitaworke3\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;

/**
 * Idioma
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Idioma
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
     * @ORM\Column(name="Idioma", type="string", length=100)
     */
    private $Idioma;

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
     * Set Idioma
     *
     * @param string $idioma
     * @return Idioma
     */
    public function setIdioma($idioma)
    {
        $this->Idioma = $idioma;
        $this->slug = Util::getSlug($idioma);
    
    
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
     * Set slug
     *
     * @param string $slug
     * @return Idioma
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
        $var= $this->getIdioma();
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
     * @return Idioma
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
