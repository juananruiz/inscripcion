<?php

namespace App\Entity\Inscripcion;

use App\Entity\Persona\Persona;
use App\Entity\Curso\Curso;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscripcionRepository")
 * @ORM\Table(name="Inscripcion")
 */
class Inscripcion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $fechaAlta;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $fechaBaja;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Persona", inversedBy="inscripciones")
     * @ORM\OrderBy({"lastName": "ASC")
     * @var Persona
     */
    private $persona;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Curso", inversedBy="inscripciones")
     * @ORM\OrderBy({"nombre": "ASC"})
     * @var Curso
     */
    private $curso;


    public function getId(): int
    {
        return $this->id;
    }

    public function getFechaAlta(): \DateTime
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta(\DateTime $fechaAlta): void
    {
        $this->fechaAlta = $fechaAlta;
    }

    public function getFechaBaja(): \DateTime
    {
        return $this->fechaBaja;
    }


    public function setFechaBaja(\DateTime $fechaBaja): void
    {
        $this->fechaBaja = $fechaBaja;
    }

    public function getPersona(): Persona
    {
        return $this->persona;
    }

    public function setPersona(Persona $persona): self
    {
        $this->persona = $persona;

        return $this;
    }

    public function getCurso(): Curso
    {
        return $this->curso;
    }

    public function setEdicion(Curso $curso): self
    {
        $this->curso = $curso;

        return $this;
    }
}
