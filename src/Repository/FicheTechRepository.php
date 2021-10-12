<?php

namespace App\Repository;

use App\Entity\FicheTech;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FicheTech|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheTech|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheTech[]    findAll()
 * @method FicheTech[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheTechRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheTech::class);
    }

    // /**
    //  * @return FicheTech[] Returns an array of FicheTech objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FicheTech
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
