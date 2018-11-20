<?php

namespace App\Controller\Gestor;

use App\Entity\Curso\Curso;
use App\Repository\CursoRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     * @Route("/crear", name="gestor_curso_crear")
     */
    public function crear()
    {
        $lugares = ['1' => 'Sevilla', '2' => 'Madrid'];
        return $this->render('gestor/curso/crear.html.twig', [
            'lugares' => $lugares,
        ]);
    }

    /**
     * @Route("/editar/{id}", requirements={"id": "\d+"}, name="gestor_curso_editar")
     */
    public function editar($id)
    {
        $curso = $this->repository->find($id);
        $lugares = ['1' => 'Sevilla', '2' => 'Madrid'];
        return $this->render('gestor/curso/editar.html.twig', [
            'curso'=> $curso,
            'lugares' => $lugares
        ]);
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

    /**
     * @Route("/grabar", name="gestor_curso_grabar")
     */
    public function grabar(Request $request)
    {
        if ($id = $request->get('id')) {
            $curso = $this->repository->find($id);
        } else {
            $curso = new Curso();
        }

        $curso->setNombre($request->get('nombre'));
        $curso->setHoras($request->get('horas'));
//        $curso->setLugar($request->get('lugar'));
        $this->repository->save($curso);

        return $this->redirectToRoute("gestor_curso_listar");
    }
}
