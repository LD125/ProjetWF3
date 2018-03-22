<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\MembreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembreRepository")
 */
class Membre implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_membre;

    /**
     * @ORM\Column(unique=true)
     * @Assert\NotBlank()
     * @var string
     */
    private $pseudo;
     /**
     * @ORM\Column(unique=true)
      * @Assert\NotBlank()
      * @Assert\Email(message="veuillez rentrer un email valide")
     * @var string
     */
    private $email;
    /**
     * @ORM\Column()
     * @var string
     */
    private $password;
    /**
     * @ORM\Column(length=20)
     * @var string
     */
    private $role = 'ROLE_USER';
    
    /**
     * @Assert\NotBlank()
     * @var string
     */
    private $plainPassword;
    
    public function getIdmembre() {
        return $this->id_membre;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }
    
    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function eraseCredentials() {
        
    }

    public function getRoles() 
    {
        return [$this->role];
    }

    public function getSalt() {
        
    }

    public function getUsername(): string {
        return $this->email;
    }

    public function __toString() 
            {
        return $this->pseudo;
    }



}
