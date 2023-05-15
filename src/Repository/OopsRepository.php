<?php

namespace VTGianni\OopsBundle\Repository;

use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use VTGianni\OopsBundle\Entity\Oops;

/**
 * @extends ServiceEntityRepository<Oops>
 *
 * @method Oops|null find($id, $lockMode = null, $lockVersion = null)
 * @method Oops|null findOneBy(array $criteria, array $orderBy = null)
 * @method Oops[]    findAll()
 * @method Oops[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OopsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oops::class);
    }

    public function save(Oops $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Oops $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param DateTime $date
     * @return mixed
     */
    public function getNbErrors(DateTime $date)
    {
        return $this->createQueryBuilder('o')
        ->select('count(o.id)')
        ->where('o.incidentDate > :date')
        ->setParameter('date', $date)
        ->getQuery()
        ->getSingleScalarResult();
    }

//    /**
//     * @return Oops[] Returns an array of Oops objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Oops
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
