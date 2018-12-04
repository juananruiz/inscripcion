<?php

namespace App\Controller\Usuario;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/" , name="usuario_inicio")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/listar", name="curso_listar")
     * @Route("/")
     */
    public function listar()
    {
        return $this->render('usuario/inicio.html.twig');
    }
}
