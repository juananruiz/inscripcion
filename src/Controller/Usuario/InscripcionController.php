<?php

namespace App\Controller\Usuario;

use App\Entity\Inscripcion\Inscripcion;
use App\Repository\CursoRepository;
use App\Repository\InscripcionEstadoRepository;
use App\Repository\InscripcionRepository;
use App\Repository\PersonaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/usuario/inscripcion")
 */
class InscripcionController extends Controller
{
    const INSCRIPCION_REAL = 1;
    const INSCRIPCION_ESPERA = 2;
    const INSCRIPCION_ANULADA = 4;

    /**
     * @var InscripcionRepository
     */
    protected $repository;


    function __construct(InscripcionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/solicitar/{curso_id}/{estado_id}", requirements={"cursoid": "\d+", "estado_id": "\d+"},  name="usuario_inscripcion_solicitar")
     * @param int $curso_id
     * @param int $estado_id
     * @param CursoRepository $cursoRepository
     * @param InscripcionEstadoRepository $estadoRepository
     * @param PersonaRepository $personaRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function solicitar(int $curso_id, int $estado_id, CursoRepository $cursoRepository,
                              InscripcionEstadoRepository $estadoRepository, PersonaRepository $personaRepository)
    {
        $inscripcion = new Inscripcion();
        $curso = $cursoRepository->find($curso_id);
        $persona = $personaRepository->find(7);
        $estado = $estadoRepository->find($estado_id);
        $inscripcion
            ->setCurso($curso)
            ->setPersona($persona)
            ->setEstado($estado)
            ->setFechaAlta(new \DateTime())
        ;
        $this->repository->save($inscripcion);

        return $this->render('usuario/inscripcion/resultado.html.twig', [
            'curso' => $inscripcion->getCurso()
        ]);
    }


    /**
     * @Route("/anular/{id}", requirements={"id": "\d+"}, name="usuario_inscripcion_anular")
     * @param int $id
     * @param InscripcionEstadoRepository $estadoRepository
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function anular(int $id, InscripcionEstadoRepository $estadoRepository)
    {
        $inscripcion = $this->repository->find($id);
        $estado = $estadoRepository->find(self::INSCRIPCION_ANULADA);
        $inscripcion->setEstado($estado);
        $this->repository->save($inscripcion);

        return $this->render('usuario/inscripcion/resultado.html.twig', [
            'curso' => $inscripcion->getCurso()
        ]);
    }
}
