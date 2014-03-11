<?php

namespace vitaworke3\CalendariBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;

/**
 * Mesos
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Mesos
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
     * @ORM\Column(name="NMes", type="integer", length=100)
     */
    private $NMes;


    /**
     * @var string
     *
     * @ORM\Column(name="Mesos", type="string", length=100)
     */
    private $Mesos;

    
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;
    
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
     * Set Mesos
     *
     * @param string $mesos
     * @return Mesos
     */
    public function setMesos($mesos)
    {
        $this->Mesos = $mesos;
        $this->slug = Util::getSlug($mesos);
    
    
        return $this;
    }

    /**
     * Get Mesos
     *
     * @return string 
     */
    public function getMesos()
    {
        return $this->Mesos;
    }


 /**
     * Set NMes
     *
     * @param string $nmes
     * @return NMes
     */
    public function setNMes($nmes)
    {
        $this->NMes = $nmes;
        $this->slug = Util::getSlug($nmes);
    
    
        return $this;
    }

    /**
     * Get NMes
     *
     * @return string 
     */
    public function getNMes()
    {
        return $this->NMes;
    }
    /**
     * Set slug
     *
     * @param string $slug
     * @return Mesos
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
        $var= $this->getMesos();
        if ($var==null)
        {
            $var=' ';
        }

        return $var;

    }
   
}
