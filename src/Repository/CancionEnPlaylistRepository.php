<?php

namespace App\Repository;

use App\Entity\CancionEnPlaylist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CancionEnPlaylist>
 *
 * @method CancionEnPlaylist|null find($id, $lockMode = null, $lockVersion = null)
 * @method CancionEnPlaylist|null findOneBy(array $criteria, array $orderBy = null)
 * @method CancionEnPlaylist[]    findAll()
 * @method CancionEnPlaylist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CancionEnPlaylistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CancionEnPlaylist::class);
    }

    //    /**
    //     * @return CancionEnPlaylist[] Returns an array of CancionEnPlaylist objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CancionEnPlaylist
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
