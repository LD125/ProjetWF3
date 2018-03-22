<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
 
/**
 * @Route("/contact")
 */
class ContactController extends Controller
{
     /**
     * @Route("/index")
     * @return type
     */
    public function index(Request $request)
    {
      
       
       $em=$this->getDoctrine()->getManager();
        
        $contact=new Contact;
     
        
        $form=$this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
                       
        if($form->isSubmitted())
        {
            if($form->isValid())
            {
                $em->persist($contact);
                $em->flush();
                $this->addFlash('success',"Le message est envoyé.");
            }
        }
         return $this->render(
            'contact/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
