<?php

namespace vitaworke3\CalendariBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Planning
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="vitaworke3\CalendariBundle\Entity\PlanningRepository")
 * 
 */
class Planning
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
     * @ORM\Column(name="slug", type="string", length=100,nullable=true)
     */
    private $slug;


    /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\ClientBundle\Entity\Client") 
      */
    
    private $Client;

   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    private $Dia1;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia2;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia3;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia4;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia5;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    private $Dia6;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia7;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia8;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia9;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia10;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    private $Dia11;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia12;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia13;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia14;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia15;
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    private $Dia16;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia17;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia18;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia19;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia20;

    /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    private $Dia21;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia22;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia23;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia24;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia25;
   
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    private $Dia26;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia27;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia28;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia29;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia30;
   
   /**
     * @var string
     *
     * /** @ORM\ManyToOne(targetEntity="vitaworke3\CalendariBundle\Entity\Calendari") 
      */
    
    private $Dia31;
   
   
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
     * Set slug
     *
     * @param string $slug
     * @return Planning
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
     * Set Client
     *
     * @param \vitaworke3\ClientBundle\Entity\Client $client
     * @return Planning
     */
    public function setClient(\vitaworke3\ClientBundle\Entity\Client $client = null)
    {
        $this->Client = $client;
    
        return $this;
    }

    /**
     * Get Client
     *
     * @return \vitaworke3\ClientBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->Client;
    }

    /**
     * Set Dia1
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia1
     * @return Planning
     */
    public function setDia1(\vitaworke3\CalendariBundle\Entity\Calendari $dia1 = null)
    {
        $this->Dia1 = $dia1;
    
        return $this;
    }

    /**
     * Get Dia1
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia1()
    {
        return $this->Dia1;
    }

    /**
     * Set Dia2
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia2
     * @return Planning
     */
    public function setDia2(\vitaworke3\CalendariBundle\Entity\Calendari $dia2 = null)
    {
        $this->Dia2 = $dia2;
    
        return $this;
    }

    /**
     * Get Dia2
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia2()
    {
        return $this->Dia2;
    }

    /**
     * Set Dia3
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia3
     * @return Planning
     */
    public function setDia3(\vitaworke3\CalendariBundle\Entity\Calendari $dia3 = null)
    {
        $this->Dia3 = $dia3;
    
        return $this;
    }

    /**
     * Get Dia3
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia3()
    {
        return $this->Dia3;
    }

    /**
     * Set Dia4
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia4
     * @return Planning
     */
    public function setDia4(\vitaworke3\CalendariBundle\Entity\Calendari $dia4 = null)
    {
        $this->Dia4 = $dia4;
    
        return $this;
    }

    /**
     * Get Dia4
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia4()
    {
        return $this->Dia4;
    }

    /**
     * Set Dia5
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia5
     * @return Planning
     */
    public function setDia5(\vitaworke3\CalendariBundle\Entity\Calendari $dia5 = null)
    {
        $this->Dia5 = $dia5;
    
        return $this;
    }

    /**
     * Get Dia5
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia5()
    {
        return $this->Dia5;
    }

    /**
     * Set Dia6
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia6
     * @return Planning
     */
    public function setDia6(\vitaworke3\CalendariBundle\Entity\Calendari $dia6 = null)
    {
        $this->Dia6 = $dia6;
    
        return $this;
    }

    /**
     * Get Dia6
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia6()
    {
        return $this->Dia6;
    }

    /**
     * Set Dia7
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia7
     * @return Planning
     */
    public function setDia7(\vitaworke3\CalendariBundle\Entity\Calendari $dia7 = null)
    {
        $this->Dia7 = $dia7;
    
        return $this;
    }

    /**
     * Get Dia7
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia7()
    {
        return $this->Dia7;
    }

    /**
     * Set Dia8
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia8
     * @return Planning
     */
    public function setDia8(\vitaworke3\CalendariBundle\Entity\Calendari $dia8 = null)
    {
        $this->Dia8 = $dia8;
    
        return $this;
    }

    /**
     * Get Dia8
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia8()
    {
        return $this->Dia8;
    }

    /**
     * Set Dia9
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia9
     * @return Planning
     */
    public function setDia9(\vitaworke3\CalendariBundle\Entity\Calendari $dia9 = null)
    {
        $this->Dia9 = $dia9;
    
        return $this;
    }

    /**
     * Get Dia9
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia9()
    {
        return $this->Dia9;
    }

    /**
     * Set Dia10
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia10
     * @return Planning
     */
    public function setDia10(\vitaworke3\CalendariBundle\Entity\Calendari $dia10 = null)
    {
        $this->Dia10 = $dia10;
    
        return $this;
    }

    /**
     * Get Dia10
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia10()
    {
        return $this->Dia10;
    }

    /**
     * Set Dia11
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia11
     * @return Planning
     */
    public function setDia11(\vitaworke3\CalendariBundle\Entity\Calendari $dia11 = null)
    {
        $this->Dia11 = $dia11;
    
        return $this;
    }

    /**
     * Get Dia11
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia11()
    {
        return $this->Dia11;
    }

    /**
     * Set Dia12
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia12
     * @return Planning
     */
    public function setDia12(\vitaworke3\CalendariBundle\Entity\Calendari $dia12 = null)
    {
        $this->Dia12 = $dia12;
    
        return $this;
    }

    /**
     * Get Dia12
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia12()
    {
        return $this->Dia12;
    }

    /**
     * Set Dia13
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia13
     * @return Planning
     */
    public function setDia13(\vitaworke3\CalendariBundle\Entity\Calendari $dia13 = null)
    {
        $this->Dia13 = $dia13;
    
        return $this;
    }

    /**
     * Get Dia13
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia13()
    {
        return $this->Dia13;
    }

    /**
     * Set Dia14
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia14
     * @return Planning
     */
    public function setDia14(\vitaworke3\CalendariBundle\Entity\Calendari $dia14 = null)
    {
        $this->Dia14 = $dia14;
    
        return $this;
    }

    /**
     * Get Dia14
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia14()
    {
        return $this->Dia14;
    }

    /**
     * Set Dia15
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia15
     * @return Planning
     */
    public function setDia15(\vitaworke3\CalendariBundle\Entity\Calendari $dia15 = null)
    {
        $this->Dia15 = $dia15;
    
        return $this;
    }

    /**
     * Get Dia15
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia15()
    {
        return $this->Dia15;
    }

    /**
     * Set Dia16
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia16
     * @return Planning
     */
    public function setDia16(\vitaworke3\CalendariBundle\Entity\Calendari $dia16 = null)
    {
        $this->Dia16 = $dia16;
    
        return $this;
    }

    /**
     * Get Dia16
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia16()
    {
        return $this->Dia16;
    }

    /**
     * Set Dia17
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia17
     * @return Planning
     */
    public function setDia17(\vitaworke3\CalendariBundle\Entity\Calendari $dia17 = null)
    {
        $this->Dia17 = $dia17;
    
        return $this;
    }

    /**
     * Get Dia17
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia17()
    {
        return $this->Dia17;
    }

    /**
     * Set Dia18
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia18
     * @return Planning
     */
    public function setDia18(\vitaworke3\CalendariBundle\Entity\Calendari $dia18 = null)
    {
        $this->Dia18 = $dia18;
    
        return $this;
    }

    /**
     * Get Dia18
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia18()
    {
        return $this->Dia18;
    }

    /**
     * Set Dia19
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia19
     * @return Planning
     */
    public function setDia19(\vitaworke3\CalendariBundle\Entity\Calendari $dia19 = null)
    {
        $this->Dia19 = $dia19;
    
        return $this;
    }

    /**
     * Get Dia19
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia19()
    {
        return $this->Dia19;
    }

    /**
     * Set Dia20
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia20
     * @return Planning
     */
    public function setDia20(\vitaworke3\CalendariBundle\Entity\Calendari $dia20 = null)
    {
        $this->Dia20 = $dia20;
    
        return $this;
    }

    /**
     * Get Dia20
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia20()
    {
        return $this->Dia20;
    }

    /**
     * Set Dia21
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia21
     * @return Planning
     */
    public function setDia21(\vitaworke3\CalendariBundle\Entity\Calendari $dia21 = null)
    {
        $this->Dia21 = $dia21;
    
        return $this;
    }

    /**
     * Get Dia21
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia21()
    {
        return $this->Dia21;
    }

    /**
     * Set Dia22
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia22
     * @return Planning
     */
    public function setDia22(\vitaworke3\CalendariBundle\Entity\Calendari $dia22 = null)
    {
        $this->Dia22 = $dia22;
    
        return $this;
    }

    /**
     * Get Dia22
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia22()
    {
        return $this->Dia22;
    }

    /**
     * Set Dia23
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia23
     * @return Planning
     */
    public function setDia23(\vitaworke3\CalendariBundle\Entity\Calendari $dia23 = null)
    {
        $this->Dia23 = $dia23;
    
        return $this;
    }

    /**
     * Get Dia23
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia23()
    {
        return $this->Dia23;
    }

    /**
     * Set Dia24
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia24
     * @return Planning
     */
    public function setDia24(\vitaworke3\CalendariBundle\Entity\Calendari $dia24 = null)
    {
        $this->Dia24 = $dia24;
    
        return $this;
    }

    /**
     * Get Dia24
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia24()
    {
        return $this->Dia24;
    }

    /**
     * Set Dia25
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia25
     * @return Planning
     */
    public function setDia25(\vitaworke3\CalendariBundle\Entity\Calendari $dia25 = null)
    {
        $this->Dia25 = $dia25;
    
        return $this;
    }

    /**
     * Get Dia25
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia25()
    {
        return $this->Dia25;
    }

    /**
     * Set Dia26
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia26
     * @return Planning
     */
    public function setDia26(\vitaworke3\CalendariBundle\Entity\Calendari $dia26 = null)
    {
        $this->Dia26 = $dia26;
    
        return $this;
    }

    /**
     * Get Dia26
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia26()
    {
        return $this->Dia26;
    }

    /**
     * Set Dia27
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia27
     * @return Planning
     */
    public function setDia27(\vitaworke3\CalendariBundle\Entity\Calendari $dia27 = null)
    {
        $this->Dia27 = $dia27;
    
        return $this;
    }

    /**
     * Get Dia27
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia27()
    {
        return $this->Dia27;
    }

    /**
     * Set Dia28
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia28
     * @return Planning
     */
    public function setDia28(\vitaworke3\CalendariBundle\Entity\Calendari $dia28 = null)
    {
        $this->Dia28 = $dia28;
    
        return $this;
    }

    /**
     * Get Dia28
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia28()
    {
        return $this->Dia28;
    }

    /**
     * Set Dia29
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia29
     * @return Planning
     */
    public function setDia29(\vitaworke3\CalendariBundle\Entity\Calendari $dia29 = null)
    {
        $this->Dia29 = $dia29;
    
        return $this;
    }

    /**
     * Get Dia29
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia29()
    {
        return $this->Dia29;
    }

    /**
     * Set Dia30
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia30
     * @return Planning
     */
    public function setDia30(\vitaworke3\CalendariBundle\Entity\Calendari $dia30 = null)
    {
        $this->Dia30 = $dia30;
    
        return $this;
    }

    /**
     * Get Dia30
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia30()
    {
        return $this->Dia30;
    }

    /**
     * Set Dia31
     *
     * @param \vitaworke3\CalendariBundle\Entity\Calendari $dia31
     * @return Planning
     */
    public function setDia31(\vitaworke3\CalendariBundle\Entity\Calendari $dia31 = null)
    {
        $this->Dia31 = $dia31;
    
        return $this;
    }

    /**
     * Get Dia31
     *
     * @return \vitaworke3\CalendariBundle\Entity\Calendari 
     */
    public function getDia31()
    {
        return $this->Dia31;
    }
}