<?php

namespace App\Controller\Gestor;

use App\Entity\Persona\Domicilio;
use App\Entity\Persona\Persona;
use App\Repository\PersonaRepository;
use App\Repository\ProvinciaRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     * @param int $id
     * @param ProvinciaRepository $provinciaRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editar(int $id, ProvinciaRepository $provinciaRepository)
    {
        $persona = $this->repository->find($id);
        $provincias = $provinciaRepository->findAll();
        if (!$persona->getDomicilio()) {
            $persona->setDomicilio(new Domicilio());
        }
        return $this->render('gestor/persona/editar.html.twig', [
            'persona' => $persona,
            'provincias' => $provincias,
        ]);
    }

    /**
     * @Route("/grabar", name="gestor_persona_grabar")
     * @param Request $request
     * @param ProvinciaRepository $provinciaRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function grabar(Request $request, ProvinciaRepository $provinciaRepository)
    {
        if ($id = $request->get('id')) {
            $persona = $this->repository->find($id);
        } else {
            $persona = new Persona();
        }
        if (!$persona->getDomicilio()) {
            $persona->setDomicilio(new Domicilio());
        }
        if ($provinciaId = $request->get('provincia_id')) {
            $provincia = $provinciaRepository->find($provinciaId);
            $persona->getDomicilio()->setProvincia($provincia);
        }
        $persona->setApellidos($request->get('apellidos'));
        $persona->setNombre($request->get('nombre'));
        $persona->setCorreo($request->get('correo'));
        $persona->setTelefono($request->get('telefono'));
        $persona->getDomicilio()->setCodigoPostal($request->get('codigo_postal'));
        $persona->getDomicilio()->setLocalidad($request->get('localidad'));
        $persona->getDomicilio()->setNumero($request->get('numero'));
        $persona->getDomicilio()->setVia($request->get('via'));
        $this->repository->save($persona);

        return $this->redirectToRoute("gestor_persona_listar");
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
        $persona = $this->repository->find($id);
        $this->repository->delete($persona);

        return $this->redirectToRoute('gestor_persona_listar');
    }
}
