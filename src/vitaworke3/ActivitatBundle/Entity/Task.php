<?php

namespace vitaworke3\ActivitatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use vitaworke3\ClientBundle\Util\Util;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tag
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Task
{
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    protected $description;

    
    /**
    * @ORM\ManyToMany(targetEntity="Tag", cascade={"persist"})
    */
    protected $tags;

   
   public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

 
    public function getTags()
    {
        return $this->tags;
    }

     public function addTag(ArrayCollection $tag)
    {
        $tag->addTask($this);
        $this->tags->add($tag);
    }

    public function removeTag($tag)
    {
        $this->tags->removeElement($tag);
    
    }
}