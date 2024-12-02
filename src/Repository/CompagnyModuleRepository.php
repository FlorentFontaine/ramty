<?php

namespace App\Repository;

use App\Entity\CompagnyModule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompagnyModule>
 *
 * @method CompagnyModule|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompagnyModule|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompagnyModule[]    findAll()
 * @method CompagnyModule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompagnyModuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompagnyModule::class);
    }

//    /**
//     * @return CompagnyModule[] Returns an array of CompagnyModule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CompagnyModule
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
