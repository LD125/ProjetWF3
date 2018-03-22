<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/messages")
 * 
 */
class ContactController extends Controller
{
      /**
     * @Route("/")
     */ 
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Contact::class);
   
        $messages=$repository->findBy(array(), array('id' => 'Asc'));
        
        return $this->render('admin/contact/index.html.twig',
                [
                    'messages'=>$messages
                ]
                
            );
    }
    
     /**
     *@Route("/delete/{id}")
     * @param int $id 
     */
    public function delete($id){
        
        $em = $this->getDoctrine()->getManager();
        //raccourci pour $em->getRepository(Category::class)->find($id);
        $message = $em->find(Contact::class, $id );
        //Suppression de la catégorie en bdd
        $em->remove($message);
        //fait  l'enregistrement en bdd
        $em->flush();
        
        $this->addFlash('danger', 'Le message est supprimé.');
       
        return $this->redirectToRoute('app_admin_contact_index');
    }
}
