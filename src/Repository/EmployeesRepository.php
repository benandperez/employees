<?php

namespace App\Repository;

use App\Entity\Employees;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Employees|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employees|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employees[]    findAll()
 * @method Employees[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Employees::class);
    }

    // /**
    //  * @return Employees[] Returns an array of Employees objects
    //  */

    public function findEmployees($value)
    {
        $query = $this->createQueryBuilder('e')

        ;
        if (ctype_digit($value)){
            $query->andWhere('e.document LIKE :val');
        }else{
            $query->andWhere('e.firstNames LIKE  :val');
        }

        $query->setParameter('val', '%'.$value.'%')
        ->orderBy('e.id', 'ASC')
        ->setMaxResults(10)
        ->getQuery();
        return $query;


    }


    /*
    public function findOneBySomeField($value): ?Employees
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
