<?php

namespace App\Controller\Gestor;

use App\Entity\Curso\Sesion;
use App\Repository\SesionRepository;
use App\Repository\SalaRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gestor/sesion")
 */
class SesionController extends Controller
{
    /**
     * @var SesionRepository
     */
    protected $repository;


    function __construct(SesionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/listar", name="gestor_sesion_listar")
     * @Route("/")
     */
    public function listar()
    {
        $sesions = $this->repository->findAll();

        return $this->render('gestor/sesion/listar.html.twig', [
            'sesions' => $sesions,
        ]);
    }


    /**
     * @Route("/crear", name="gestor_sesion_crear")
     */
    public function crear(SalaRepository $salaRepository)
    {
        $salas = $salaRepository->findAll();
        return $this->render('gestor/sesion/crear.html.twig', [
            'salas' => $salas,
        ]);
    }

    /**
     * @Route("/editar/{id}", requirements={"id": "\d+"}, name="gestor_sesion_editar")
     */
    public function editar($id, SalaRepository $salaRepository)
    {
        $sesion = $this->repository->find($id);
        $salas = $salaRepository->findAll();
        return $this->render('gestor/sesion/editar.html.twig', [
            'sesion' => $sesion,
            'salas' => $salas,
        ]);
    }


    /**
     * @Route("/grabar", name="gestor_sesion_grabar")
     */
    public function grabar(Request $request, SalaRepository $salaRepository)
    {
        if ($id = $request->get('id')) {
            $sesion = $this->repository->find($id);
        } else {
            $sesion = new Sesion();
        }
        $sala = $salaRepository->find($request->get('sala_id'));
        $sesion->setFechaInicio($request->get('nombre'));
        $sesion->setDuracion($request->get('horas'));
        $this->repository->save($sesion);

        return $this->redirectToRoute("gestor_sesion_listar");
    }

    /**
     * @Route("/borrar/{id}", requirements={"id": "\d+"}, name="gestor_sesion_borrar")
     */
    public function borrar($id)
    {
        $sesion = $this->repository->find($id);
        try {
            $this->repository->delete($sesion);
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }

        return $this->redirectToRoute('gestor_sesion_listar');
    }
}
