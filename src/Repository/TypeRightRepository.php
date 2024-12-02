<?php

namespace App\Repository;

use App\Entity\TypeRight;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeRight>
 *
 * @method TypeRight|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRight|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRight[]    findAll()
 * @method TypeRight[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRightRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeRight::class);
    }

//    /**
//     * @return TypeRight[] Returns an array of TypeRight objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeRight
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
