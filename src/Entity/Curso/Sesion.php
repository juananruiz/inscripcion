<?php

namespace App\Entity\Curso;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SesionRepository")
 */
class Sesion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Curso\Curso", inversedBy="sesiones")
     * @var Curso
     */
    private $curso;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaInicio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaFin;

    /**
     * @ORM\Column(type="time")
     */
    private $duracion;


    public function getId()
    {
        return $this->id;
    }

    public function getCurso(): Curso
    {
        return $this->curso;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(?\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getDuracion(): ?\DateTimeInterface
    {
        return $this->duracion;
    }

    public function setDuracion(\DateTimeInterface $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

}
