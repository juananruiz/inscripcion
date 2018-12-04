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
     * @Route("/solicitar/{id}/{estado_id}", requirements={"id": "\d+", "estado_id": "\d+"},  name="usuario_inscripcion_solicitar")
     * @param int $id
     * @param int $estado_id
     * @param InscripcionEstadoRepository $estadoRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function solicitar(int $id, int $estado_id, InscripcionEstadoRepository $estadoRepository)
    {
        $inscripcion = $this->repository->find($id);
        $estado = $estadoRepository->find($estado_id);
        $inscripcion->setEstado($estado);
        $this->repository->save($inscripcion);

        return $this->redirectToRoute('usuario_curso_listar');
    }

    /**
     * @Route("/grabar", name="usuario_inscripcion_grabar")
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

        return $this->redirectToRoute('usuario_curso_listar');
    }

    /**
     * @Route("/anular/{id}", requirements={"id": "\d+"}, name="usuario_inscripcion_anular")
     * @param int $id
     * @param InscripcionEstadoRepository $estadoRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function cambiarEstado(int $id, int $estado_id, InscripcionEstadoRepository $estadoRepository)
    {
        $inscripcion = $this->repository->find($id);
        $estado = $estadoRepository->find($estado_id);
        $inscripcion->setEstado($estado);
        $this->repository->save($inscripcion);

        return $this->redirectToRoute('gestor_curso_mostrar', [
            'id' => $inscripcion->getCurso()->getId(),
        ]);
    }
}
