<?php

namespace App\Repository;

use App\Entity\TeamDrivers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TeamDrivers|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamDrivers|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamDrivers[]    findAll()
 * @method TeamDrivers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamDriversRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeamDrivers::class);
    }

    // /**
    //  * @return TeamDrivers[] Returns an array of TeamDrivers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TeamDrivers
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
