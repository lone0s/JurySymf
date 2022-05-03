<?php

namespace App\Repository;

use App\Entity\InscriptionsEpreuves;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InscriptionsEpreuves>
 *
 * @method InscriptionsEpreuves|null find($id, $lockMode = null, $lockVersion = null)
 * @method InscriptionsEpreuves|null findOneBy(array $criteria, array $orderBy = null)
 * @method InscriptionsEpreuves[]    findAll()
 * @method InscriptionsEpreuves[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionsEpreuvesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InscriptionsEpreuves::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(InscriptionsEpreuves $entity, bool $flush = true): void
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
    public function remove(InscriptionsEpreuves $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return InscriptionsEpreuves[] Returns an array of InscriptionsEpreuves objects
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
    public function findOneBySomeField($value): ?InscriptionsEpreuves
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
