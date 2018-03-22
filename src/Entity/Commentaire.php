<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Restaraunt")
     * @ORM\JoinColumn(nullable=false)
     * @var Restaraunt 
     */
   private $restaraunt;
   
   /**
    * @ORM\Column()
    * @ORM\ManyToOne(targetEntity="Membre")
    * @ORM\JoinColumn(nullable=false)
    * @var Membre 
    */
   private $membre;
    
    /**
     *@ORM\Column(type="text")
     * @var string 
     */
    private $commentaire;
    
    /** 
    * @ORM\Column(type="date") 
    *   
    */
    private $datecomment;
    
    /**
     *@ORM\Column(type="integer")
     * @Assert\Length(min=1,max=5)
     * @var int 
     */
    private $notecomment;
    
    public function getId() {
        return $this->id;
    }

    public function getRestaraunt() {
        return $this->restaraunt;
    }

    public function getMembre() {
        return $this->membre;
    }

    public function getCommentaire() {
        return $this->commentaire;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setRestaraunt($restaraunt) {
        $this->restaraunt = $restaraunt;
    }

    public function setMembre($membre) {
        $this->membre = $membre;
    }

    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;
    }

    function getNotecomment() {
        return $this->notecomment;
    }

    function setNotecomment($notecomment) {
        $this->notecomment = $notecomment;
    }
    function getDatecomment() {
        return $this->datecomment;
    }

    function setDatecomment($datecomment) {
        $this->datecomment = $datecomment;
    }

    public function __construct() {
        $this->datecomment = new \DateTime("now");
    }

    
}