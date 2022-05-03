<?php

namespace App\Repository;

use App\Entity\NaturesEpreuve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NaturesEpreuve>
 *
 * @method NaturesEpreuve|null find($id, $lockMode = null, $lockVersion = null)
 * @method NaturesEpreuve|null findOneBy(array $criteria, array $orderBy = null)
 * @method NaturesEpreuve[]    findAll()
 * @method NaturesEpreuve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NaturesEpreuvesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NaturesEpreuve::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(NaturesEpreuve $entity, bool $flush = true): void
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
    public function remove(NaturesEpreuve $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return NaturesEpreuve[] Returns an array of NaturesEpreuve objects
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
    public function findOneBySomeField($value): ?NaturesEpreuve
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
