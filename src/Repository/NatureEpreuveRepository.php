<?php

namespace App\Repository;

use App\Entity\NatureEpreuve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NatureEpreuve>
 *
 * @method NatureEpreuve|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureEpreuve|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureEpreuve[]    findAll()
 * @method NatureEpreuve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureEpreuveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureEpreuve::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(NatureEpreuve $entity, bool $flush = true): void
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
    public function remove(NatureEpreuve $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return NatureEpreuve[] Returns an array of NatureEpreuve objects
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
    public function findOneBySomeField($value): ?NatureEpreuve
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
