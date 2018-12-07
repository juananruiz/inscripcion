<?php

namespace App\Controller\Gestor;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/gestor")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="gestor_inicio")
     * @Route("/inicio", name="gestor_inicio_1")
     */
    public function index()
    {
        return $this->render('gestor/inicio.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
