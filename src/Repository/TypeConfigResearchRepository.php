<?php

namespace App\Repository;

use App\Entity\TypeConfigResearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TypeConfigResearch>
 *
 * @method TypeConfigResearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeConfigResearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeConfigResearch[]    findAll()
 * @method TypeConfigResearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeConfigResearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeConfigResearch::class);
    }

    public function save(TypeConfigResearch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TypeConfigResearch $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAll(): array
    {
        return $this->findBy([], ['position' => 'ASC']);
    }

//    /**
//     * @return TypeConfigResearch[] Returns an array of TypeConfigResearch objects
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

//    public function findOneBySomeField($value): ?TypeConfigResearch
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
