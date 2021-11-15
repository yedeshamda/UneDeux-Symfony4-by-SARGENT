<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

     /**
      * @return Blog[] Returns an array of Blog objects
      */

    public function findByVideo()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.type = :val')
            ->setParameter('val', 'video')
            ->orderBy('b.datecreation', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Blog[] Returns an array of Blog objects
     */

    public function findByBlog()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.type = :val')
            ->setParameter('val', 'blog')
            ->orderBy('b.datecreation', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Blog[] Returns an array of Blog objects
     */

    public function findByCreationDate()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.datecreation', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?Blog
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
