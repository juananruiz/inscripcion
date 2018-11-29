<?php

namespace App\Controller\Gestor;

use App\Entity\Curso\Sesion;
use App\Repository\CursoRepository;
use App\Repository\SesionRepository;
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


    /**
     * @param SesionRepository $repository
     */
    function __construct(SesionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/editar/{id}", requirements={"id": "\d+"}, name="gestor_sesion_editar")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editar(int $id)
    {
        $sesion = $this->repository->find($id);
        return $this->render('gestor/sesion/editar.html.twig', [
            'sesion' => $sesion,
        ]);
    }

    /**
     * @Route("/grabar", name="gestor_sesion_grabar")
     * @param Request $request
     * @param CursoRepository $cursoRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function grabar(Request $request, CursoRepository $cursoRepository)
    {
        if ($id = $request->get('id')) {
            $sesion = $this->repository->find($id);
        } else {
            $sesion = new Sesion();
            // Si es una sesión nueva necesitamos saber el curso
            if (!$curso_id = $request->get('curso_id')) {
                return $this->redirectToRoute("gestor_curso_listar");
            }
            $curso = $cursoRepository->find($curso_id);
            $sesion->setCurso($curso);
        }
        $sesion
            ->setFechaInicio(new \DateTime($request->get('fecha_inicio')))
            ->setDuracion(new \DateTime($request->get('duracion')));
        $this->repository->save($sesion);

        return $this->redirectToRoute("gestor_curso_mostrar", ['id' => $sesion->getCurso()->getId()]);
    }

    /**
     * @Route("/borrar/{id}", requirements={"id": "\d+"}, name="gestor_sesion_borrar")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function borrar(int $id)
    {
        $sesion = $this->repository->find($id);

        try {
            $this->repository->delete($sesion);
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }

        return $this->redirectToRoute('gestor_curso_mostrar', ['id' => $sesion->getCurso()->getId()]);
    }
}
