<?php

namespace App\Repository;

use App\Entity\Curso\Curso;
use App\Entity\Persona\Persona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Persona|null find($id, $lockMode = null, $lockVersion = null)
 * @method Persona|null findOneBy(array $criteria, array $orderBy = null)
 * @method Persona[]    findAll()
 * @method Persona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Persona::class);
    }
    
    /**
     * @param Persona $persona
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(Persona $persona)
    {
        parent::getEntityManager()->remove($persona);
        parent::getEntityManager()->flush();
    }

    /**
     * @param Persona $persona
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Persona $persona)
    {
        parent::getEntityManager()->persist($persona);
        parent::getEntityManager()->flush();
    }

    /**
     * @param Curso $curso
     * @return mixed
     */
    public function findCandidatos(Curso $curso)
    {
        /*
            SELECT persona.*
            FROM persona
            WHERE persona.id NOT IN(
	            SELECT p.id  FROM persona p
	            INNER JOIN inscripcion i ON i.persona_id = p.id
	            WHERE i.curso_id = 1);
        */
        $subqb  = $this->_em->createQueryBuilder();
        $subqb->select('p1.id')
            ->from('App:Persona\Persona', 'p1')
            ->innerJoin('p1.inscripciones', 'i')
            ->where('i.curso = :curso');
        // También se podría haber hecho el join al revés
        //  ->from('App:Inscripcion\Inscripcion', 'i')
        //  ->innerJoin('i.persona', 'p1')
        //  ->where('i.curso = :curso');

        $qb  = $this->_em->createQueryBuilder();
        $qb->select('p2')
            ->from('App:Persona\Persona', 'p2')
            ->where($qb->expr()->notIn('p2.id',  $subqb->getDQL()));
        $qb->setParameter('curso', $curso);

        return $qb->getQuery()->getResult();
    }
}
