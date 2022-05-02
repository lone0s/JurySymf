<?php

namespace App\Repository;

use App\Entity\ParcoursUes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ParcoursUes>
 *
 * @method ParcoursUes|null find($id, $lockMode = null, $lockVersion = null)
 * @method ParcoursUes|null findOneBy(array $criteria, array $orderBy = null)
 * @method ParcoursUes[]    findAll()
 * @method ParcoursUes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParcoursUesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ParcoursUes::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ParcoursUes $entity, bool $flush = true): void
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
    public function remove(ParcoursUes $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ParcoursUes[] Returns an array of ParcoursUes objects
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
    public function findOneBySomeField($value): ?ParcoursUes
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
