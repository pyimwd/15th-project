<?php

namespace App\Repository;

use App\Entity\UserCollecting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserCollecting|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCollecting|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCollecting[]    findAll()
 * @method UserCollecting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCollectingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserCollecting::class);
    }

    // /**
    //  * @return UserCollecting[] Returns an array of UserCollecting objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserCollecting
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
