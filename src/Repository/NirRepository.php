<?php

namespace App\Repository;

use App\Entity\Nir;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nir|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nir|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nir[]    findAll()
 * @method Nir[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NirRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nir::class);
    }

    // /**
    //  * @return Nir[] Returns an array of Nir objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nir
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
