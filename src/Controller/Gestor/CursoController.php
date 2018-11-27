<?php

namespace App\Controller\Gestor;

use App\Entity\Curso\Curso;
use App\Repository\CursoRepository;
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
     * @Route("/")
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
     */
    public function mostrar($id)
    {
        $curso = $this->repository->find($id);
        return $this->render('gestor/curso/mostrar.html.twig', [
            'curso' => $curso,
        ]);
    }


    /**
     * @Route("/crear", name="gestor_curso_crear")
     */
    public function crear(SalaRepository $salaRepository)
    {
        $salas = $salaRepository->findAll();
        return $this->render('gestor/curso/crear.html.twig', [
            'salas' => $salas,
        ]);
    }

    /**
     * @Route("/editar/{id}", requirements={"id": "\d+"}, name="gestor_curso_editar")
     */
    public function editar($id, SalaRepository $salaRepository)
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
     */
    public function grabar(Request $request, SalaRepository $salaRepository)
    {
        if ($id = $request->get('id')) {
            $curso = $this->repository->find($id);
        } else {
            $curso = new Curso();
        }
        $sala = $salaRepository->find($request->get('sala_id'));
        $curso->setHoras($request->get('horas'));
        $curso->setNombre($request->get('nombre'));
        $curso->setPlazas($request->get('plazas'));
        $curso->setSala($sala);
        $this->repository->save($curso);

        return $this->redirectToRoute("gestor_curso_listar");
    }

    /**
     * @Route("/borrar/{id}", requirements={"id": "\d+"}, name="gestor_curso_borrar")
     */
    public function borrar($id)
    {
        $curso = $this->repository->find($id);
        try {
            $this->repository->delete($curso);
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }

        return $this->redirectToRoute('gestor_curso_listar');
    }
}
