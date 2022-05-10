<?php

namespace App\Repository;

use App\Entity\Livraison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livraison|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livraison|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livraison[]    findAll()
 * @method Livraison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivraisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livraison::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Livraison $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Livraison $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Livraison[] Returns an array of Livraison objects
    //  */
    public function findByLivreurId($livreur_id)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.livreur = :livreur_id')
            ->setParameter('livreur_id', $livreur_id)
            ->orderBy('l.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function changeEtat(Livraison $livraison)
    {
        if ($livraison->getEtat() == "Livré") {
            $livraison->setEtat("En cours");
        } else {
            $livraison->setEtat("Livré");
        }
        $this->_em->persist($livraison);
        $this->_em->flush();
    }

    public function findDaily(): ?array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('DAY(l.CreatedAt) = :date')
            ->setParameter('date', date('d'))
            ->getQuery()
            ->getResult();
    }

    public function findMonthly(): ?array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('MONTH(l.CreatedAt) = :date')
            ->setParameter('date', date('m'))
            ->getQuery()
            ->getResult();
    }

    public function findYearly($year): ?array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('YEAR(l.CreatedAt) = :date')
            ->setParameter('date', $year)
            ->getQuery()
            ->getResult();
    }

    public function findByMonth($month): ?array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('MONTH(l.CreatedAt) = :month')
            ->setParameter('month', $month)
            ->getQuery()
            ->getResult();
    }
}
