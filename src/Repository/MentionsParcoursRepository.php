<?php

namespace App\Repository;

use App\Entity\MentionsParcours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MentionsParcours>
 *
 * @method MentionsParcours|null find($id, $lockMode = null, $lockVersion = null)
 * @method MentionsParcours|null findOneBy(array $criteria, array $orderBy = null)
 * @method MentionsParcours[]    findAll()
 * @method MentionsParcours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MentionsParcoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MentionsParcours::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MentionsParcours $entity, bool $flush = true): void
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
    public function remove(MentionsParcours $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return MentionsParcours[] Returns an array of MentionsParcours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MentionsParcours
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
