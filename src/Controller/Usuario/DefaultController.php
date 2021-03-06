<?php

namespace App\Controller\Usuario;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    /**
     * @Route("/inicio", name="usuario_inicio")
     * @Route("/", name="usuario_inicio_1")
     */
    public function listar()
    {
        return $this->render('usuario/inicio.html.twig');
    }

    /**
     * @Route("/mi_cuenta", name="usuario_mi_cuenta")
     */
    public function miCuenta()
    {
        return $this->render('usuario/mi_cuenta.html.twig');
    }
}
