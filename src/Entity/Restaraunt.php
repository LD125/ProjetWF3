<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\RestarauntRepository;
use App\Entity\Type;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RestarauntRepository")
 */
class Restaraunt
{
    /**
     * @ORM\id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @Assert\NotBlank(message="Le nom est obligatoire")
     *@ORM\Column(length=20,unique=true)
     * 
     * @var type 
     */
    
    private $nom;
    
    /**
     *@ORM\Column(type="integer")
     * @Assert\Range(
     * min=1,
     *  max=5 )
     * @var type 
     */
    
    
    private $note;
    
    
    /**
     *
     * @var type 
     * @ORM\Column(length=20)
     * @Assert\NotBlank(message="Le nom est obligatoire")
     */
    
    private $ville;
    
    /**
     *@ORM\Column(type="integer")
     * @Assert\Length(
     * min=5,
     * max=5
     * )
     * @var type 
     */
     private $cdp;
    
    /**
     *@ORM\Column(length=20)
     * @var type 
     */
    private $specialite;
        
    /**
     *@ORM\Column(type="text")
     *
     */
    private $adresse;
    
    /**
     *@ORM\Column(type="text")
     *
     */
    private $telephone;
    
    /**
     * @ORM\Column(nullable=true)
     * @Assert\Image()
     * @var string
     */
    
    private $image;
    
    
    /**
     * @ORM\Column(type="text")
     * @var type 
     */
    
    private $description;
    
    /**
     * @ORM\Column(type="text")
     */
    
    
    private $article;
    
   public function getId() {
        return $this->id;
    }

   public function getNom() {
        return $this->nom;
    }

  public  function getNote() {
        return $this->note;
    }

  public  function getVille() {
        return $this->ville;
    }

   public function getCdp() {
        return $this->cdp;
    }

   public function getSpecialite() {
        return $this->specialite;
    }

   public function getImage() {
        return $this->image;
    }

   public function getDescription() {
        return $this->description;
    }

  public  function getArticle() {
        return $this->article;
    }

   public function setId($id) {
        $this->id = $id;
    }

   public function setNom($nom) {
        $this->nom = $nom;
    }

   public function setNote($note) {
        $this->note = $note;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function setCdp($cdp) {
        $this->cdp = $cdp;
    }

   public  function setSpecialite($specialite) {
        $this->specialite = $specialite;
    }

   public function setImage($image) {
        $this->image = $image;
    }

   public function setDescription($description) {
        $this->description = $description;
    }

   public function setArticle($article) {
        $this->article = $article;
    }
    
     public function getAdresse(){
        return $this->adresse;
    }

   public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }


    
    
    
    
    



}


