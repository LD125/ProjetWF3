<?php

namespace App\Repository;

use App\Entity\Restaraunt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Restaraunt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaraunt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaraunt[]    findAll()
 * @method Restaraunt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestarauntRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Restaraunt::class);
    }
    
    public function afficheMieulleuresRestaraunts($limit)
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT r.nom, ROUND(AVG(c.notecomment),1) AS average_note FROM restaraunt r,commentaire c WHERE r.id=c.restaraunt_id GROUP BY r.nom ORDER BY AVG(c.notecomment) DESC LIMIT 0,$limit";
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
    }
    
    public function affichePireRestaraunts($limit)
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT r.nom,ROUND(AVG(c.notecomment),1) AS average_note FROM restaraunt r,commentaire c WHERE r.id=c.restaraunt_id GROUP BY r.nom ORDER BY AVG(c.notecomment) ASC LIMIT 0,$limit";
        $resultat=$connection->query($sql);
        
        return $resultat->fetchAll();
        
    }
    
    public function restarauntTrierParCommentaire($limit)
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT r.nom, COUNT(c.commentaire) AS amount FROM restaraunt r,commentaire c WHERE r.id=c.restaraunt_id GROUP BY r.nom ORDER BY COUNT(c.commentaire) DESC LIMIT 0,$limit";
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
       
    }
    
    public function afficheRestarauntsRecents($limit)
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT id,nom,image FROM restaraunt GROUP BY id DESC LIMIT 0,$limit";
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
    }
    
    public function choisirSpecialite()
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT specialite FROM restaraunt GROUP BY specialite";
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
    }
    
    public function afficheSpecialite($specialite)
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT * FROM restaraunt WHERE specialite='".$specialite."'";
        $resultat=$connection->query($sql);
        dump($resultat);
        return $resultat->fetchAll();
    }
    
    public function choisirVille()
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT ville FROM restaraunt GROUP BY ville";
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
    }
    
    public function afficheVille($ville)
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT * FROM restaraunt WHERE ville='".$ville."'";
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
    }
}
