<?php

namespace App\Repository;

use App\Entity\Curso\Curso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Curso|null find($id, $lockMode = null, $lockVersion = null)
 * @method Curso|null findOneBy(array $criteria, array $orderBy = null)
 * @method Curso[]    findAll()
 * @method Curso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CursoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Curso::class);
    }

    /**
     * @param Curso $curso
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Curso $curso)
    {
        parent::getEntityManager()->remove($curso);
        parent::getEntityManager()->flush();
    }

    /**
     * @param Curso $curso
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Curso $curso)
    {
        parent::getEntityManager()->persist($curso);
        parent::getEntityManager()->flush();
    }

//    /**
//     * @return Curso[] Returns an array of Curso objects
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
    public function findOneBySomeField($value): ?Curso
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
