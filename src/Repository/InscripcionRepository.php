<?php

namespace App\Repository;

use App\Entity\Curso\Curso;
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

    public function findInscripcionesReales(Curso $curso)
    {
        return $this->createQueryBuilder('i')
            ->innerJoin('i.estado', 'e')
            ->andWhere('i.curso = :curso')
            ->andWhere('e.id = :inscrito_abonado OR e.id = :inscrito_impagado')
            ->setParameter('curso', $curso)
            ->setParameter('inscrito_abonado', 1)
            ->setParameter('inscrito_impagado', 2)
            ->orderBy('i.fechaAlta', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findInscripcionesEspera(Curso $curso)
    {
        return $this->createQueryBuilder('i')
            ->innerJoin('i.estado', 'e')
            ->andWhere('i.curso = :curso')
            ->andWhere('e.id = :inscrito_espera')
            ->setParameter('curso', $curso)
            ->setParameter('inscrito_espera', 3)
            ->orderBy('i.fechaAlta', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findInscripcionesAnuladas(Curso $curso)
    {
        return $this->createQueryBuilder('i')
            ->innerJoin('i.estado', 'e')
            ->andWhere('i.curso = :curso')
            ->andWhere('e.id = :inscrito_anulado')
            ->setParameter('curso', $curso)
            ->setParameter('inscrito_anulado', 4)
            ->orderBy('i.fechaAlta', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
