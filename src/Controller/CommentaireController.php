<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Restaraunt;
use App\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comments")
 */
class CommentaireController extends Controller
{
   /**
    * @Route("/")
    */
    
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Commentaire::class);
   
        $commentaires=$repository->findBy(array(), array('id' => 'Asc'));
        
        return $this->render('commentaire/index.html.twig',
                [
                    'commentaires'=>$commentaires
                ]
                
            );
    }

    /**
     * @Route("/ajout/{id}")
     */
    
    public function ajout(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        
        $repository=$em->getRepository(Restaraunt::class);
        $restaraunt=$repository->find($id);
        
        $commentaire=new Commentaire;
        $commentaire->setMembre($this->getUser());
        $commentaire->setRestaraunt($restaraunt);
        $form=$this->createForm(CommentaireType::class,$commentaire);
        $form->handleRequest($request);
        
        $this->denyAccessUnlessGranted(['ROLE_USER','ROLE_ADMIN'], null, 'Unable to access this page!');
        
        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $em->persist($commentaire);
                $em->flush();
                $this->addFlash('success',"Le commentaire est enregistre");
            }
        }
         return $this->render(
            'commentaire/ajout.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}