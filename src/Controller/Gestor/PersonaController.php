<?php

namespace App\Controller\Gestor;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/gestor/persona")
 */
class PersonaController extends Controller
{
    /**
     * @Route("/listar", name="gestor_persona_listar")
     * @Route("/")
     */
    public function index()
    {
        return $this->render('gestor/persona/index.html.twig', [
            'controller_name' => 'PersonaController',
        ]);
    }
}
