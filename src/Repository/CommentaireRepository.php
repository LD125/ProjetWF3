<?php

namespace App\Repository;

use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }
    
    public function afficheMembreLesPlusActife($limit)
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT m.pseudo,COUNT(c.commentaire) AS amount FROM membre m,commentaire c WHERE m.pseudo=c.membre GROUP BY m.pseudo ORDER BY COUNT(c.commentaire) DESC LIMIT 0,$limit";
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
                  
    }
    
    public function afficheLesCommentairesRecents($limit)
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT c.membre,c.commentaire,r.nom AS restaraunt FROM commentaire c,restaraunt r WHERE c.restaraunt_id=r.id GROUP BY r.nom LIMIT 0,$limit";
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
    }
    
    public function SelectCommentaire($restaraunt, $limit) 
    {
        $connection=$this->getEntityManager()->getConnection();
        $sql="SELECT * FROM commentaire c, restaraunt r WHERE c.restaraunt_id=r.id AND r.id=$restaraunt ORDER BY datecomment DESC LIMIT 0,$limit";
        $resultat=$connection->query($sql);
        return $resultat->fetchAll();
        
    }
    
  

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.something = :value')->setParameter('value', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}