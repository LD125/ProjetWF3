<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\Restaraunt;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Restaraunt::class);
        $repository2 = $this->getDoctrine()->getRepository(Article::class);
        
        $articles=$repository2->afficheArticlesRecents(3);
        $restaraunts=$repository->afficheRestarauntsRecents(3);
        
          return $this->render('index/index.html.twig', 
                [
            'restaraunts' => $restaraunts,
            'articles' => $articles
                
        ]);
    }
     /**
     * @Route("/stats")
     */
    public function stats()
    {
        $restarauntRepository=$this->getDoctrine()->getRepository(Restaraunt::class);
        $commentaireRepository=$this->getDoctrine()->getRepository(Commentaire::class);
        $mielleuresRestaraunts=$restarauntRepository->afficheMieulleuresRestaraunts(3);
        $restarauntCommentaires=$restarauntRepository->restarauntTrierParCommentaire(3);
        $piresRestaraunts=$restarauntRepository->affichePireRestaraunts(3);
        $restarauntRecents=$restarauntRepository->afficheRestarauntsRecents(3);
        $membreLesPlusActifs=$commentaireRepository->afficheMembreLesPlusActife(3);
        $commentaireRecents=$commentaireRepository->afficheLesCommentairesRecents(2);
        
        return $this->render('index/stats.html.twig',
            [
                'mielleuresRestaraunts'=>$mielleuresRestaraunts,
                'piresRestaraunts'=>$piresRestaraunts,
                'trieRestaraunts'=>$restarauntCommentaires,
                'restarauntsRecents'=>$restarauntRecents,
                'membresLesPlusActifs'=>$membreLesPlusActifs,
                'commentairesRecents'=>$commentaireRecents        
            ]    
               
                
          );
    }
}
