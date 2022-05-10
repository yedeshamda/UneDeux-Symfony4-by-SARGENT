<?php

namespace App\Repository;

use App\Entity\Notification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Notification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notification[]    findAll()
 * @method Notification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    public function notifAdmin($user)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.message = :val')
            ->OrWhere('n.message = :val3')
            ->andWhere('n.user = :val2')
            ->setParameter('val',"Une DEUX viens de recevoir une nouvelle inscription")
            ->setParameter('val3',"Une DEUX viens de recevoir un message")
            ->setParameter('val2',$user)
            ->getQuery()
            ->getResult();
    }

    public function nbrNotif($user)
    {
        return $this->createQueryBuilder('n')
            ->select('count(n.id)')
            ->andWhere('n.message = :val')
            ->OrWhere('n.message = :val3')
            ->andWhere('n.lecture = :val2')
            ->andWhere('n.user = :val3')
            ->setParameter('val',"Une DEUX viens de recevoir une nouvelle inscription")
            ->setParameter('val3',"Une DEUX viens de recevoir un message")
            ->setParameter('val2',0)
            ->setParameter('val3',$user)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function notifLimit8admin($user)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.message = :val')
            ->OrWhere('n.message = :val3')
            ->andWhere('n.user = :val2')
            ->setParameter('val',"Une DEUX viens de recevoir une nouvelle inscription")
            ->setParameter('val3',"Une DEUX viens de recevoir un message")
            ->setParameter('val2',$user)
            ->orderBy('n.date_creation', 'DESC')
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();
    }

}
