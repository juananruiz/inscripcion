<?php

namespace App\Entity\Evento;

use App\Entity\Persona\Persona;
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Edicion", inversedBy="inscripciones"
     * @ORM\OrderBy({"nombre": "ASC"})
     * @var Edicion
     */
    private $edicion;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getFechaAlta(): \DateTime
    {
        return $this->fechaAlta;
    }

    /**
     * @param \DateTime $fechaAlta
     */
    public function setFechaAlta(\DateTime $fechaAlta): void
    {
        $this->fechaAlta = $fechaAlta;
    }

    /**
     * @return \DateTime
     */
    public function getFechaBaja(): \DateTime
    {
        return $this->fechaBaja;
    }

    /**
     * @param \DateTime $fechaBaja
     */
    public function setFechaBaja(\DateTime $fechaBaja): void
    {
        $this->fechaBaja = $fechaBaja;
    }

    /**
     * @return Persona
     */
    public function getPersona(): Persona
    {
        return $this->persona;
    }

    /**
     * @param Persona $persona
     * @return Inscripcion
     */
    public function setPersona(Persona $persona): self
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * @return Edicion
     */
    public function getEdicion()
    {
        return $this->edicion;
    }

    /**
     * @param Edicion $edicion
     * @return Inscripcion
     */
    public function setEdicion($edicion): self
    {
        $this->edicion = $edicion;

        return $this;
    }
}
