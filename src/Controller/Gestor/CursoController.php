<?php

namespace App\Controller\Gestor;

use App\Entity\Curso\Curso;
use App\Repository\CursoRepository;
use App\Repository\InscripcionRepository;
use App\Repository\PersonaRepository;
use App\Repository\SalaRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gestor/curso")
 */
class CursoController extends Controller
{
    /**
     * @var CursoRepository
     */
    protected $repository;


    function __construct(CursoRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/listar", name="gestor_curso_listar")
     * @Route("/", name="gestor_curso_listar_1")
     */
    public function listar()
    {
        $cursos = $this->repository->findAll();

        return $this->render('gestor/curso/listar.html.twig', [
            'cursos' => $cursos,
        ]);
    }

    /**
     * @Route("/mostrar/{id}", requirements={"id": "\d+"}, name="gestor_curso_mostrar")
     * @param int $id
     * @param InscripcionRepository $inscripcionRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mostrar(int $id, InscripcionRepository $inscripcionRepository)
    {
        $curso = $this->repository->find($id);
        $inscripcionesReales = $inscripcionRepository->findInscripcionesReales($curso);
        $inscripcionesEspera = $inscripcionRepository->findInscripcionesEspera($curso);
        $inscripcionesAnuladas = $inscripcionRepository->findInscripcionesAnuladas($curso);
        return $this->render('gestor/curso/mostrar.html.twig', [
            'curso' => $curso,
            'inscripcionesReales' =>  $inscripcionesReales,
            'inscripcionesEspera' => $inscripcionesEspera,
            'inscripcionesAnuladas' => $inscripcionesAnuladas,
        ]);
    }

    /**
     * @Route("/crear", name="gestor_curso_crear")
     * @param SalaRepository $salaRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function crear(SalaRepository $salaRepository)
    {
        $salas = $salaRepository->findAll();
        return $this->render('gestor/curso/crear.html.twig', [
            'salas' => $salas,
        ]);
    }

    /**
     * @Route("/copiar/{id}", requirements={"id": "\d+"}, name="gestor_curso_copiar")
     * @param int $id
     * @param SalaRepository $salaRepository
     * @throws ORMException
     * @throws OptimisticLockException
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function copiar(int $id, SalaRepository $salaRepository)
    {
        $cursoOrigen = $this->repository->find($id);
        $cursoDestino = clone $cursoOrigen;
        $this->repository->save($cursoDestino);
        $salas = $salaRepository->findAll();
        return $this->render('gestor/curso/editar.html.twig', [
            'curso' => $cursoDestino,
            'salas' => $salas,
        ]);
    }

    /**
     * @Route("/editar/{id}", requirements={"id": "\d+"}, name="gestor_curso_editar")
     * @param int $id
     * @param SalaRepository $salaRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editar(int $id, SalaRepository $salaRepository)
    {
        $curso = $this->repository->find($id);
        $salas = $salaRepository->findAll();
        return $this->render('gestor/curso/editar.html.twig', [
            'curso' => $curso,
            'salas' => $salas,
        ]);
    }

    /**
     * @Route("/grabar", name="gestor_curso_grabar")
     * @param Request $request
     * @param SalaRepository $salaRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function grabar(Request $request, SalaRepository $salaRepository)
    {
        if ($id = $request->get('id')) {
            $curso = $this->repository->find($id);
        } else {
            $curso = new Curso();
        }
        $sala = $salaRepository->find($request->get('sala_id'));
        $curso->setCodigo($request->get('codigo'));
        $curso->setDescripcion($request->get('descripcion'));
        $curso->setFechas($request->get('fechas'));
        $curso->setHoras($request->get('horas'));
        $curso->setModulo($request->get('modulo'));
        $curso->setNombre($request->get('nombre'));
        $curso->setPlazas($request->get('plazas'));
        $curso->setSala($sala);
        $curso->setTurno($request->get('turno'));
        $this->repository->save($curso);

        return $this->redirectToRoute("gestor_curso_listar");
    }

    /**
     * @Route("/borrar/{id}", requirements={"id": "\d+"}, name="gestor_curso_borrar")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function borrar(int $id)
    {
        $curso = $this->repository->find($id);
        try {
            $this->repository->delete($curso);
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }

        return $this->redirectToRoute('gestor_curso_listar');
    }

    /**
     * @Route("/candidatos/{id}", requirements={"id": "\d+"}, name="gestor_curso_candidatos")
     * @param int $id
     * @param PersonaRepository $personaRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function candidatos(int $id, PersonaRepository $personaRepository)
    {
        $curso = $this->repository->find($id);
        $candidatos = $personaRepository->findCandidatos($curso);

        return $this->render('gestor/curso/candidatos.html.twig', [
            'curso' => $curso,
            'candidatos' => $candidatos,
        ]);
    }
}
