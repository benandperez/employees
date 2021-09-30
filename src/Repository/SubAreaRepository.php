<?php

namespace App\Repository;

use App\Entity\SubArea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubArea|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubArea|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubArea[]    findAll()
 * @method SubArea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubAreaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubArea::class);
    }

    // /**
    //  * @return SubArea[] Returns an array of SubArea objects
    //  */

    public function findSubarea($value): \Doctrine\ORM\Query
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.description LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
        ;
    }


    /*
    public function findOneBySomeField($value): ?SubArea
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
