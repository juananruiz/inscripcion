<?php

namespace App\Repository;

use App\Entity\Geo\Sala;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sala|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sala|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sala[]    findAll()
 * @method Sala[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sala::class);
    }

    /**
     * @param Sala $sala
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Sala $sala)
    {
        parent::getEntityManager()->remove($sala);
        parent::getEntityManager()->flush();
    }

    /**
     * @param Sala $sala
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Sala $sala)
    {
        parent::getEntityManager()->persist($sala);
        parent::getEntityManager()->flush();
    }

//    /**
//     * @return Sala[] Returns an array of Sala objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sala
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
