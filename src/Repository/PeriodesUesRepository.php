<?php

namespace App\Repository;

use App\Entity\PeriodesUes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PeriodesUes>
 *
 * @method PeriodesUes|null find($id, $lockMode = null, $lockVersion = null)
 * @method PeriodesUes|null findOneBy(array $criteria, array $orderBy = null)
 * @method PeriodesUes[]    findAll()
 * @method PeriodesUes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeriodesUesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PeriodesUes::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PeriodesUes $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(PeriodesUes $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return PeriodesUes[] Returns an array of PeriodesUes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PeriodesUes
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
