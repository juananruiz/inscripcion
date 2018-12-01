<?php

namespace App\Repository;

use App\Entity\Inscripcion\Inscripcion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Inscripcion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Inscripcion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Inscripcion[]    findAll()
 * @method Inscripcion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscripcionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Inscripcion::class);
    }

    public function findInscripcionesReales()
    {
        return $this->createQueryBuilder('i')
            ->innerJoin('i.estado', 'e')
            ->andWhere('e.id = :inscrito_abonado OR e.id = :inscrito_impagado')
            ->setParameter('inscrito_abonado', 1)
            ->setParameter('inscrito_impagado', 2)
            ->orderBy('i.fechaAlta', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findInscripcionesEspera()
    {
        return $this->createQueryBuilder('i')
            ->innerJoin('i.estado', 'e')
            ->andWhere('e.id = :inscrito_espera')
            ->setParameter('inscrito_espera', 3)
            ->orderBy('i.fechaAlta', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
