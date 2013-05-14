<?php

namespace vitaworke3\ClientBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campanya
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Campanya
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
     * /** @ORM\OneToOne(targetEntity="vitaworke3\ClientBundle\Entity\Client") 
     */
    private $Client;

     /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100)
     */
    private $slug;


   

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DataInicial", type="datetime")
     */
    private $DataInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DataFinal", type="datetime")
     */
    private $DataFinal;


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
     * Set Client
     *
     * @param string $client
     * @return Campanya
     */
    public function setClient(\vitaworke3\ClientBundle\Entity\Client $client)
    {
        $this->Client = $client;
    
        return $this;
    }

    /**
     * Get Client
     *
     * @return string 
     */
    public function getClient()
    {
        return $this->Client;
    }

   /**
     * Set slug
     *
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
     * Set DataInicial
     *
     * @param \DateTime $dataInicial
     * @return Campanya
     */
    public function setDataInicial($dataInicial)
    {
        $this->DataInicial = $dataInicial;
    
        return $this;
    }

    /**
     * Get DataInicial
     *
     * @return \DateTime 
     */
    public function getDataInicial()
    {
        return $this->DataInicial;
    }

    /**
     * Set DataFinal
     *
     * @param \DateTime $dataFinal
     * @return Campanya
     */
    public function setDataFinal($dataFinal)
    {
        $this->DataFinal = $dataFinal;
    
        return $this;
    }

    /**
     * Get DataFinal
     *
     * @return \DateTime 
     */
    public function getDataFinal()
    {
        return $this->DataFinal;
    }
}
