<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @route("/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
   
        $articles=$repository->findBy(array(), array('id' => 'Asc'));
        
          return $this->render('admin/article/index.html.twig', 
                [
            'articles' => $articles
                
        ]);
    }
    
    /**
     * @Route("/edit/{id}", defaults={"id": null})
     */
    public function edit(Request $request, $id)
    {
         $em = $this->getDoctrine()->getManager();
         $originalImage1 = null;
         $originalImage2 = null;
         $originalImage3 = null;
        if (is_null($id)){
        $article = new Article;
        }else{ //modification
            $article = $em->find(Article::class, $id);
            
            if(!is_null($article->getImage1())){
                $originalImage1 = $article->getImage1();
                $imagePath1 = $this->getParameter('upload_dir'). '/' .$originalImage1;
                $article->setImage1(new File($imagePath1));
            }
            if(!is_null($article->getImage2())){
                $originalImage2 = $article->getImage2();
                $imagePath2 = $this->getParameter('upload_dir'). '/' .$originalImage2;
                $article->setImage2(new File($imagePath2));
            }
            if(!is_null($article->getImage3())){
                $originalImage3 = $article->getImage3();
                $imagePath3 = $this->getParameter('upload_dir'). '/' .$originalImage3;
                $article->setImage3(new File($imagePath3));
            }
        }
        
        //création du formulaire lié à la catégorie'article
        $form = $this->createForm(ArticleType::class, $article);
        //le formulaire traite la requête HTTP
        $form->handleRequest($request);
           
        // si le formulaire a été envoyé
        if($form->isSubmitted()){
            //s'il n'y a pas d'erreurs de validation du formulaire 
            if($form->isValid()){
                
                
                 /** @var UploadedFile $image */
                 
                $image1 = $article->getImage1();
                $image2 = $article->getImage2();
                $image3 = $article->getImage3();
                
                if(!is_null($image1)&& !is_null($image2) && !is_null($image3)){
                    //nom du fichier que l'on va enregistrer
                    $filename1 = uniqid() .'.'.$image1->guessExtension();
                    $filename2 = uniqid() .'.'.$image2->guessExtension();
                    $filename3 = uniqid() .'.'.$image3->guessExtension();
                    
                    //équivalent move_uploaded_file()
                    $image1->move(
                            $this->getParameter('upload_dir'),
                            $filename1
                            );
                    $article->setImage1($filename1);
                    
                    $image2->move(
                            $this->getParameter('upload_dir'),
                            $filename2
                            );
                    $article->setImage2($filename2);
                    
                    $image3->move(
                            $this->getParameter('upload_dir'),
                            $filename3
                            );
                    $article->setImage3($filename3);
                    
                    //supression de l'ancienne image en modification
                    if (!is_null($originalImage1)){
                        unlink($this->getParameter('upload_dir') .'/'. $originalImage1);
                    }
                    if (!is_null($originalImage2)){
                        unlink($this->getParameter('upload_dir') .'/'. $originalImage2);
                    }
                    if (!is_null($originalImage3)){
                        unlink($this->getParameter('upload_dir') .'/'. $originalImage3);
                    }
                }
                //prépare l'enregistrement en bdd
                $em->persist($article);
                //fait  l'enregistrement en bdd
                $em->flush();
                //ajout du message flash
                $this->addFlash('success', 'L\'article a été enregistré');
                // redirection vers la liste
                return $this->redirectToRoute('app_admin_article_index');
            }else {
                $this->addFlash('error', 'Le Formulaire contient des erreurs');
            }
            
        }
        
        
        
        return $this->render('admin/article/edit.html.twig', 
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
        $article = $em->find(Article::class, $id );
        //Suppression de la catégorie en bdd
        $em->remove($article);
        //fait  l'enregistrement en bdd
        $em->flush();
        
        $this->addFlash('danger', 'L\'article est supprimé');
       
        return $this->redirectToRoute('app_admin_article_index');
    }
}
