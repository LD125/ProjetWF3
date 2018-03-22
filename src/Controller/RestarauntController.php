<?php
namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Restaraunt;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @route("/restaurant")
 */
class RestarauntController extends Controller
{
    
    
    /**
     * @Route("/index/")
     * @return type
     */
    
    
    public function index()
    {
        $repository=$this->getDoctrine()->getRepository(Restaraunt::class);
        $restaraunts=$repository->findAll();
        $options=$repository->choisirSpecialite();
        $villes=$repository->choisirVille();
        
        return $this->render('restaraunt/index.html.twig',
               [
                  'restaraunts'=>$restaraunts,
                   'options'=>$options,
                    'villes'=>$villes
               ]
                  
          );
    }
    
    /**
     * @Route("/index/{specialite}")
     */
    
    
    public function specialite_options($specialite)
    {
        $repository=$this->getDoctrine()->getRepository(Restaraunt::class);
        $choix=$repository->afficheSpecialite($specialite);
        dump($choix);
        return $this->render('restaraunt/afficheSpecialite.html.twig',
                [
                    'choix'=>$choix
                ]    
          );
          
    }
     /**
     * @Route("/index{ville}")
     * @param type $ville
     * @return type
     */
    
    public function choisir_ville($ville)
    {
        $repository=$this->getDoctrine()->getRepository(Restaraunt::class);
        $villes=$repository->afficheVille($ville);
        dump($ville);
        return $this->render('restaraunt/afficheVille.html.twig',
                [
                    'villes'=>$villes
                ]
                
                
                
           );
    }
    /*
    public function specialite_options()
    {
        
        $repository=$this->getDoctrine()->getRepository(Restaraunt::class);
        $options=$repository->choisirSpecialite();
        
        return $this->render('restaraunt/index.html.twig',
                [
                    'options'=>$options,
                    
                ]
          );
    }
     
     */
    
    /**
     * 
     * @Route("/affiche/{id}")
     */
    public function afficheCommentaire($id) 
    {
   
        
        $repository=$this->getDoctrine()->getRepository(Commentaire::class);
        $commentaires=$repository->SelectCommentaire($id, 100);
       
    
       
       
              
       return $this->render('restaraunt/afficheCommentaire.html.twig',
               [
                   
                  'commentaires'=>$commentaires,
                  
               ]
               
               
         );
    }
 
    /**
     * @route("/{id}")
     */
    public function ficheRestaraunt(Restaraunt $restaraunt, $id)
    {
        $repository=$this->getDoctrine()->getRepository(Commentaire::class);
        $commentaires=$repository->SelectCommentaire($id, 3);
        
        return $this->render(
            'restaraunt/ficherestaraunt.html.twig', 
            [
            'restaraunt'=>$restaraunt,
            'commentaires' => $commentaires
            ]
        );
    }
    
    
}
    