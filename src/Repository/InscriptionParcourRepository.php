<?php

namespace App\Repository;

use App\Entity\InscriptionParcour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InscriptionParcour>
 *
 * @method InscriptionParcour|null find($id, $lockMode = null, $lockVersion = null)
 * @method InscriptionParcour|null findOneBy(array $criteria, array $orderBy = null)
 * @method InscriptionParcour[]    findAll()
 * @method InscriptionParcour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionParcourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InscriptionParcour::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(InscriptionParcour $entity, bool $flush = true): void
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
    public function remove(InscriptionParcour $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return InscriptionParcour[] Returns an array of InscriptionParcour objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InscriptionParcour
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
