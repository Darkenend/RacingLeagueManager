<?php

namespace App\Repository;

use App\Entity\TeamEntryList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TeamEntryList|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeamEntryList|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeamEntryList[]    findAll()
 * @method TeamEntryList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamEntryListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeamEntryList::class);
    }

    public function getRaceResult($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.race_id = :val')
            ->setParameter('val', $value)
            ->orderBy('t.result', 'ASC')
            ->addOrderBy('t.Laps', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return TeamEntryList[] Returns an array of TeamEntryList objects
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
    public function findOneBySomeField($value): ?TeamEntryList
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
