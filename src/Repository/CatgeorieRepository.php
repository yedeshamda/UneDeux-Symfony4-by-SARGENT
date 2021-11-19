<?php

namespace App\Repository;

use App\Entity\Catgeorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Catgeorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Catgeorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Catgeorie[]    findAll()
 * @method Catgeorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatgeorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Catgeorie::class);
    }

    // /**
    //  * @return Catgeorie[] Returns an array of Catgeorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Catgeorie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
