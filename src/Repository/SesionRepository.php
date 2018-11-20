<?php

namespace App\Repository;

use App\Entity\Curso\Sesion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sesion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sesion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sesion[]    findAll()
 * @method Sesion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SesionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sesion::class);
    }

    /**
     * @param Sesion $sesion
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Sesion $sesion)
    {
        parent::getEntityManager()->remove($sesion);
        parent::getEntityManager()->flush();
    }

    /**
     * @param Sesion $sesion
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Sesion $sesion)
    {
        parent::getEntityManager()->persist($sesion);
        parent::getEntityManager()->flush();
    }

    /*
    public function findByExampleField($value): Sesion
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sesion
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
