<?php
 
namespace vitaworke3\UsuarisBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
 
/**
 * @ORM\Entity(repositoryClass="vitaworke3\UsuarisBundle\Entity\UsuariRepository")
 * @ORM\Table(name="Usuari")
 */
class Usuari extends BaseUser
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Agrega un rol al usuario.
     * @throws Exception
     * @param Rol $rol 
     */
   //public function addRole( $rol )
   //{
	 // array_push($this->roles, 'ROLE_ADMIN');
	 //}
     public function addRole($role)
    {
        $role = strtoupper($role);
        //if ($role === static::ROLE_DEFAULT) {
        //    return $this;
        //}

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }
    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }

        return $this;
    }
}

