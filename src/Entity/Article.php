<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column()
     * @var string 
     */
    private $title;
    
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     * @var string
     */
    private $content;
  
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     * @var string
     */
    private $description;
    
    /**
     * fetch="EAGER pour eviter le LAZY LOADING
     * 
     * @ORM\ManyToOne(targetEntity="Restaraunt",fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     * @var Restaraunt
     * @Assert\NotBlank()
     * 
     */
    private $restaraunt;
    
    
    /**
     *@ORM\Column(nullable=true)
     * @var string 
     */
    private $image1;
    /**
     *@ORM\Column(nullable=true)
     * @var string 
     */
    private $image2;
    /**
     *@ORM\Column(nullable=true)
     * @var string 
     */
    private $image3;
    
    /** 
    * @ORM\Column(type="date") 
    *   
    */
    private $datearticle;
    
    function getDatearticle() {
        return $this->datearticle;
    }

    function setDatearticle($datearticle) {
        $this->datearticle = $datearticle;
    }

        
    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getRestaraunt(){
        return $this->restaraunt;
    }


    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setRestaraunt(Restaraunt $restaraunt) {
        $this->restaraunt = $restaraunt;
        return $this;
    }


    function getImage1() {
        return $this->image1;
    }

    function getImage2() {
        return $this->image2;
    }

    function getImage3() {
        return $this->image3;
    }

    function setImage1($image1) {
        $this->image1 = $image1;
    }

    function setImage2($image2) {
        $this->image2 = $image2;
    }

    function setImage3($image3) {
        $this->image3 = $image3;
    }

    public function __construct() {
        $this->datearticle = new \Datetime("now");
    }

}
