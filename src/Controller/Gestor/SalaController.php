<?php

namespace App\Controller\Gestor;

use App\Entity\Geo\Sala;
use App\Repository\ProvinciaRepository;
use App\Repository\SalaRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gestor/sala")
 */
class SalaController extends Controller
{
    /**
     * @var SalaRepository
     */
    protected $repository;


    function __construct(SalaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/listar", name="gestor_sala_listar")
     * @Route("/", name="gestor_sala_listar_1")
     */
    public function listar()
    {
        $salas = $this->repository->findAll();

        return $this->render('gestor/sala/listar.html.twig', [
            'salas' => $salas,
        ]);
    }

    /**
     * @Route("/mostrar/{id}", requirements={"id": "\d+"}, name="gestor_sala_mostrar")
     * @param int $id
     * @param ProvinciaRepository $provinciaRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function mostrar(int $id)
    {
        $sala = $this->repository->find($id);
        return $this->render('gestor/sala/mostrar.html.twig', [
            'sala' => $sala,
        ]);
    }

    /**
     * @Route("/crear", name="gestor_sala_crear")
     * @param ProvinciaRepository $provinciaRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function crear(ProvinciaRepository $provinciaRepository)
    {
        $provincias = $provinciaRepository->findAll();
        return $this->render('gestor/sala/crear.html.twig', [
            'provincias' => $provincias,
        ]);
    }

    /**
     * @Route("/editar/{id}", requirements={"id": "\d+"}, name="gestor_sala_editar")
     * @param int $id
     * @param ProvinciaRepository $provinciaRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editar(int $id, ProvinciaRepository $provinciaRepository)
    {
        $sala = $this->repository->find($id);
        $provincias = $provinciaRepository->findAll();
        return $this->render('gestor/sala/editar.html.twig', [
            'sala' => $sala,
            'provincias' => $provincias,
        ]);
    }

    /**
     * @Route("/grabar", name="gestor_sala_grabar")
     * @param Request $request
     * @param ProvinciaRepository $provinciaRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function grabar(Request $request, ProvinciaRepository $provinciaRepository)
    {
        if ($id = $request->get('id')) {
            $sala = $this->repository->find($id);
        } else {
            $sala = new Sala();
        }
        $provincia = $provinciaRepository->find($request->get('provincia_id'));
        $sala->setAforo((int)$request->get('aforo'));
        $sala->setNombre($request->get('nombre'));
        $sala->setDireccion($request->get('direccion'));
        $sala->setLocalidad($request->get('localidad'));
        $sala->setProvincia($provincia) ;
        $sala->setMapaUrl($request->get('mapa_url'));
        $this->repository->save($sala);

        return $this->redirectToRoute("gestor_sala_listar");
    }

    /**
     * @Route("/borrar/{id}", requirements={"id": "\d+"}, name="gestor_sala_borrar")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function borrar(int $id)
    {
        $sala = $this->repository->find($id);
        $this->repository->delete($sala);

        return $this->redirectToRoute('gestor_sala_listar');
    }
}
