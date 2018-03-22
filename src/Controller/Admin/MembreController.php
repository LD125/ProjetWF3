<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use App\Form\MembreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
  
/**
     * @Route("/membre")
     */
class MembreController extends Controller
{
/**
     * @Route("/",)
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Membre::class);
   
        $membres=$repository->findBy(array(), array('id_membre' => 'Asc'));
        return $this->render('admin/membre/index.html.twig', 
                [
            'membres' => $membres
                
        ]);
        
    }
     /**
     * @Route("/edit/{id_membre}", defaults={"id_membre": null})
     */
    public function edit(Request $request, $id_membre)
    {
        
        $em = $this->getDoctrine()->getManager();
        
        if (is_null($id_membre)){
        $membre = new Membre;
        }else{
            $membre= $em->getRepository(Membre::class)->find($id_membre);
        }
        
        //création du formulaire lié à la catégorie
        $form = $this->createForm(MembreType::class, $membre);
        //le formulaire traite la requête HTTP
        $form->handleRequest($request);
           
        // si le formulaire a été envoyé
        if($form->isSubmitted()){
            //s'il n'y a pas d'erreurs de validation du formulaire 
            if($form->isValid()){
                //prépare l'enregistrement en bdd
                $em->persist($membre);
                //fait  l'enregistrement en bdd
                $em->flush();
                //ajout du message flash
                $this->addFlash('success', 'Le membre a été enregistrée');
                // redirection vers la liste
                return $this->redirectToRoute('app_admin_membre_index');
            }else {
                $this->addFlash('error', 'Le Formulaire contient des erreurs');
            }
            
        }
        return $this->render('admin/membre/edit.html.twig', 
                [
            'form' => $form->createView()
                
        ]);
        
    }
    
    /**
     *@Route("/delete/{id_membre}")
     * @param int $id_membre 
     */
    public function delete($id_membre){
        
        $em = $this->getDoctrine()->getManager();
        //raccourci pour $em->getRepository(Category::class)->find($id);
        $membre = $em->find(Membre::class, $id_membre );
        //Suppression de la catégorie en bdd
        $em->remove($membre);
        //fait  l'enregistrement en bdd
        $em->flush();
        
        $this->addFlash('danger', 'Le membre est supprimée');
       
        return $this->redirectToRoute('app_admin_membre_index');
    }

}
