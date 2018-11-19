<?php

namespace App\Controller\Gestor;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/gestor/curso")
 */
class CursoController extends Controller
{
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
}
