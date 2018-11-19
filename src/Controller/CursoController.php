<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/curso")
 */
class CursoController extends Controller
{
    /**
     * @Route("/listar", name="curso_listar"
     * @Route("/")
     */
    public function listar()
    {
        return $this->render('curso/index.html.twig', [
            'controller_name' => 'CursoController',
        ]);
    }
}
