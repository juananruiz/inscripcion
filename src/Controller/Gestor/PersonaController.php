<?php

namespace App\Controller\Gestor;

use App\Repository\PersonaRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/gestor/persona")
 */
class PersonaController extends Controller
{
    /**
     * @var PersonaRepository
     */
    protected $repository;


    function __construct(PersonaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/listar", name="gestor_persona_listar")
     * @Route("/")
     */
    public function listar()
    {
        $personas = $this->repository->findAll();

        return $this->render('gestor/persona/listar.html.twig', [
            'personas' => $personas,
        ]);
    }

    /**
     * @Route("/crear", name="gestor_persona_crear")
     */
    public function crear()
    {
        return $this->render('gestor/persona/crear.html.twig');
    }

    /**
     * @Route("/editar/{id}", name="gestor_persona_editar")
     */
    public function editar(int $id)
    {
        $persona = $this->repository->find($id);

        return $this->render('gestor/persona/editar.html.twig', [
            'persona' => $persona,
        ]);
    }

    /**
     * @Route("/borrar/{id}", requirements={"id": "\d+"}, name="gestor_persona_borrar")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function borrar(int $id)
    {
        $sala = $this->repository->find($id);
        $this->repository->delete($sala);

        return $this->redirectToRoute('gestor_persona_listar');
    }
}
