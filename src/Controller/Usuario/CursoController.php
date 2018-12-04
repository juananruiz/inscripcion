<?php

namespace App\Controller\Usuario;

use App\Repository\CursoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/curso")
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
     * @Route("/listar", name="usuario_curso_listar")
     * @Route("/")
     */
    public function listar()
    {
        $cursos = $this->repository->findAll();

        return $this->render('usuario/curso/listar.html.twig', [
            'cursos' => $cursos,
        ]);
    }

    /**
     * @Route("/mostrar/{id}", requirements={"id": "\d+"}, name="usuario_curso_mostrar")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mostrar(int $id)
    {
        $curso = $this->repository->find($id);
        return $this->render('usuario/curso/mostrar.html.twig', [
            'curso' => $curso,
        ]);
    }
}
