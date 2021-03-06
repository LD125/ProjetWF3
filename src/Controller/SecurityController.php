<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends Controller
{
    /**
     * @Route("/inscription")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $membre = new Membre();
        $form = $this->createForm(MembreType::class, $membre);
        
        $form->handleRequest($request);
         if ($form->isSubmitted()) {
             if ($form->isValid()){
               $password = $passwordEncoder->encodePassword($membre, $membre->getPlainPassword()
                       );
               $membre->setPassword($password);
               $em = $this->getDoctrine()->getManager();
               $em->persist($membre);
               $em->flush();
               
               $this->addFlash('success', 'Votre compte est créé');
               
               return $this->redirectToRoute('app_index_index');
               
             } else {
                $this->addFlash('error', 'Le formulaire contient des erreurs');
            }
         }
        
        return $this->render(
                'security/register.html.twig',
                [
                    'form' => $form->createView()
                ]   
            );
    }
    /**
     * 
     * @Route ("/connexion")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render(
                'security/login.html.twig',
                [
                    'error' => $error,
                    'last_username' => $lastUsername,
                ]
                );
    }
    /**
     * @Route("/Deconnexion")
     */
    public function logout()
    {
        
    }
}
