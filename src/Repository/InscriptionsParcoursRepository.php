<?php

namespace App\Repository;

use App\Entity\InscriptionsParcours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InscriptionsParcours>
 *
 * @method InscriptionsParcours|null find($id, $lockMode = null, $lockVersion = null)
 * @method InscriptionsParcours|null findOneBy(array $criteria, array $orderBy = null)
 * @method InscriptionsParcours[]    findAll()
 * @method InscriptionsParcours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionsParcoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InscriptionsParcours::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(InscriptionsParcours $entity, bool $flush = true): void
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
    public function remove(InscriptionsParcours $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return InscriptionsParcours[] Returns an array of InscriptionsParcours objects
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
    public function findOneBySomeField($value): ?InscriptionsParcours
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
