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
class Tag
{
   
   /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    public $name;

    public function addActivitat(Activitat $activitat)
	{
    	if (!$this->activitat->contains($activitat)) {
        $this->activitat->add($activitat);
    	}
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


}