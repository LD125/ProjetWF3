<?php

namespace App\Controller\Admin;

use App\Entity\Restaraunt;
use App\Form\RestarauntType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @route("/restaurant")
 */
class RestaurantController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Restaraunt::class);
   
        $restaraunts=$repository->findBy(array(), array('id' => 'Asc'));
        
          return $this->render('admin/restaurant/index.html.twig', 
                [
            'restaraunts' => $restaraunts
                
        ]);
    }
    
    /**
     * @Route("/edit/{id}", defaults={"id": null})
     */
    public function edit(Request $request, $id)
    {
         $em = $this->getDoctrine()->getManager();
         $originalImage = null;
        if (is_null($id)){
        $restaraunt = new Restaraunt;
        }else{ //modification
            $restaraunt = $em->find(Restaraunt::class, $id);
            
            if(!is_null($restaraunt->getImage())){
                $originalImage = $restaraunt->getImage();
                $imagePath = $this->getParameter('upload_dir'). '/' .$originalImage;
                $restaraunt->setImage (new File($imagePath));
            }
        }
        
        //création du formulaire lié à l'a catégorie'article
        $form = $this->createForm(RestarauntType::class, $restaraunt);
        //le formulaire traite la requête HTTP
        $form->handleRequest($request);
           
        // si le formulaire a été envoyé
        if($form->isSubmitted()){
            //s'il n'y a pas d'erreurs de validation du formulaire 
            if($form->isValid()){
                
                
                 /** @var UploadedFile $image */
                 
                $image = $restaraunt->getImage();
                
                //s'il y a une image uploadée
                if(!is_null($image)){
                    //nom du fichier que l'on va enregistrer
                    $filename = uniqid() .'.'.$image->guessExtension();
                    
                    //équivalent move_uploaded_file()
                    $image->move(
                            $this->getParameter('upload_dir'),
                            $filename
                            );
                    $restaraunt->setImage($filename);
                    
                    //supression de l'ancienne image en modification
                    if (!is_null($originalImage)){
                        unlink($this->getParameter('upload_dir') .'/'. $originalImage);
                    }
                } else {
                    // getData sur une checkbox = true si cochée, false sinon 
                    if ($form->has('removed') && $form->get('remove_image')->getData()){
                        $restaraunt->setImage(null);
                        unlink($this->getParameter('upload_dir').'/'.$originalImage);
                    } else {
                        $restaraunt->setImage($originalImage);
                    }
                }
                
                //prépare l'enregistrement en bdd
                $em->persist($restaraunt);
                //fait  l'enregistrement en bdd
                $em->flush();
                //ajout du message flash
                $this->addFlash('success', 'Le restaurant a été enregistré.');
                // redirection vers la liste
                return $this->redirectToRoute('app_admin_restaurant_index');
            }else {
                $this->addFlash('error', 'Le Formulaire contient des erreurs.');
            }
            
        }
        
        
        
        return $this->render('admin/restaurant/edit.html.twig', 
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
        $restaraunt = $em->find(Restaraunt::class, $id );
        //Suppression de la catégorie en bdd
        $em->remove($restaraunt);
        //fait  l'enregistrement en bdd
        $em->flush();
        
        $this->addFlash('danger', 'Le restaurant est supprimé.');
       
        return $this->redirectToRoute('app_admin_restaurant_index');
    }
}
