<?php

namespace App\Controller\Gestor;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/gestor")
 */
class HomeController extends Controller
{
    /**
     * @Route("/inicio", name="gestor_inicio")
     * @Route("/")
     */
    public function index()
    {
        return $this->render('gestor/persona/index.html.twig', [
            'controller_name' => 'PersonaController',
        ]);
    }
}
