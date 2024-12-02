<?php

namespace App\Repository;

use App\Entity\StatusCandidacy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StatusCandidacy>
 *
 * @method StatusCandidacy|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusCandidacy|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusCandidacy[]    findAll()
 * @method StatusCandidacy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusCandidacyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusCandidacy::class);
    }

    public function save(StatusCandidacy $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(StatusCandidacy $entity, bool $flush = false): void
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
//     * @return StatusCandidacy[] Returns an array of StatusCandidacy objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?StatusCandidacy
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
