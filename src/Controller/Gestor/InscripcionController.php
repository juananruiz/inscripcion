<?php

namespace App\Controller\Gestor;

use App\Entity\Inscripcion\Inscripcion;
use App\Repository\CursoRepository;
use App\Repository\InscripcionEstadoRepository;
use App\Repository\InscripcionRepository;
use App\Repository\PersonaRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/gestor/inscripcion")
 */
class InscripcionController extends Controller
{
    /**
     * @var InscripcionRepository
     */
    protected $repository;


    function __construct(InscripcionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/grabar", name="gestor_inscripcion_grabar")
     * @param Request $request
     * @param CursoRepository $cursoRepository
     * @param PersonaRepository $personaRepository
     * @param InscripcionEstadoRepository $estadoRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function grabar(Request $request, CursoRepository $cursoRepository, PersonaRepository $personaRepository,
                           InscripcionEstadoRepository $estadoRepository)
    {
        $curso = $cursoRepository->find($request->get('curso_id'));
        $persona = $personaRepository->find($request->get('persona_id'));
        $estado = $estadoRepository->find($request->get('estado_id'));

        $inscripcion = new Inscripcion();
        $inscripcion
            ->setCurso($curso)
            ->setPersona($persona)
            ->setEstado($estado)
            ->setFechaAlta(new \DateTime())
        ;
        $this->repository->save($inscripcion);

        return $this->redirectToRoute('gestor_curso_mostrar', [
            'id' => $curso->getId(),
        ]);
    }
}
