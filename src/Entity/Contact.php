<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    
     /**
     * @ORM\Column()
      * @Assert\NotBlank()
      * @Assert\Email(message="veuillez rentrer un email valide")
     * @var string
     */
    private $Email;
    
    
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     * @var string
     */
    private $Objet;
    
   
    
    
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     * @var string
     */
    private $Message;
   
    
    
    /** 
    * @ORM\Column(type="date") 
    *   
    */
    private $date;
    
    public function getId() {
        return $this->id;
    }


    public function getObjet() {
        return $this->Objet;
    }

    public function getMessage() {
        return $this->Message;
    }

    public function getDate() {
        return $this->date;
    }

   

    public function setObjet($Objet) {
        $this->Objet = $Objet;
    }

    public function setMessage($Message) {
        $this->Message = $Message;
    }



    public function __construct() {
        $this->date = new \DateTime("now");
    }


    public function getEmail() {
        return $this->Email;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }


}
