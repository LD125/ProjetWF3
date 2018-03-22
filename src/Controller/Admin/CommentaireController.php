<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commentaire")
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
        
        return $this->render('admin/commentaire/index.html.twig',
                [
                    'commentaires'=>$commentaires
                ]
                
            );
    }
    /**
     * @Route("/edit/{id}", defaults={"id": null})
     */
    public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        if (is_null($id)){
        $commentaire = new Commentaire;
        }else{ //modification
            $commentaire = $em->find(commentaire::class, $id);           
        }
        
        $form=$this->createForm(CommentaireType::class,$commentaire);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $em->persist($commentaire);
                $em->flush();
                 $this->addFlash('success', "le commentaire est enregistré");
            }
        }
        return $this->render('admin/commentaire/edit.html.twig', 
                [
           
                'form' => $form->createView()
        ]);
    }
      /**
     *@Route("/delete/{id}")
     * @param int $id 
     */
    public function delete($id){
        
        $em = $this->getDoctrine()->getManager();
        //raccourci pour $em->getRepository(Category::class)->find($id);
        $commentaire = $em->find(Commentaire::class, $id );
        //Suppression de la catégorie en bdd
        $em->remove($commentaire);
        //fait  l'enregistrement en bdd
        $em->flush();
        
        $this->addFlash('danger', 'Le commentaire est supprimé');
       
        return $this->redirectToRoute('app_admin_commentaire_index');
    }
}



