<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;


/**
 * @route("/blog")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
   
        $articles=$repository->afficheArticlesRecents(100);
        
          return $this->render('article/index.html.twig', 
                [
            'articles' => $articles
                
        ]);
    }
    /**
     * @route("/{id}")
     */
    public function ficheArticle(Article $article)
    {
        return $this->render(
            'article/fichearticle.html.twig', 
            [
            'article' => $article
            ]
        );
    }
    
}
