<?php

namespace App\Controller\Gestor;

use App\Repository\CursoRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
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
        return $this->render('curso/index.html.twig', [
            'controller_name' => 'CursoController',
        ]);
    }

    /**
     * @Route("/crear", name="gestor_curso_crear")
     */
    public function crear()
    {
        $lugares = ['1' => 'Sevilla', '2' => 'Madrid'];
        return $this->render('gestor/curso/crear.html.twig', ['lugares' => $lugares]);
    }

    /**
     * @Route("/grabar", name="gestor_curso_grabar")
     */
    public function grabar()
    {
        return $this->redirectToRoute("gestor_curso_listar");
    }
}
