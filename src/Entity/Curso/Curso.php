<?php

namespace App\Entity\Curso;

use App\Entity\Geo\Sala;
use App\Entity\Inscripcion\Inscripcion;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CursoRepository")
 */
class Curso
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $nombre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $horas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscripcion\Inscripcion", mappedBy="curso")
     * @ORM\OrderBy({"fechaAlta": "DESC"})
     * @var Inscripcion[]|ArrayCollection
     */
    private $inscripciones;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Geo\Sala")
     * @var Sala
     */
    private $sala;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Curso\Sesion", mappedBy="curso")
     * @ORM\OrderBy({"fechaInicio": "ASC"})
     * @var Sesion[]|ArrayCollection
     */
    private $sesiones;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="integer")
     */
    private $plazas;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $modulo;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $codigo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fechas;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank
     */
    private $turno;


    public function __construct()
    {
        $this->inscripciones = new ArrayCollection();
        $this->sesiones = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getInscripciones() : Collection
    {
        return $this->inscripciones;
    }

    public function addInscripcion(Inscripcion $inscripcion): void
    {
        $this->inscripciones[] = $inscripcion;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getHoras(): int
    {
        return $this->horas;
    }

    public function setHoras(int $horas): self
    {
        $this->horas = $horas;

        return $this;
    }

    public function getSala(): ?Sala
    {
        return $this->sala;
    }

    public function setSala(Sala $sala): self
    {
        $this->sala = $sala;

        return $this;
    }

    public function getSesiones(): Collection
    {
        return $this->sesiones;
    }

    public function getPlazas(): ?int
    {
        return $this->plazas;
    }

    public function setPlazas(int $plazas): self
    {
        $this->plazas = $plazas;

        return $this;
    }

    public function getModulo(): ?string
    {
        return $this->modulo;
    }

    public function setModulo(?string $modulo): self
    {
        $this->modulo = $modulo;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getFechas(): ?string
    {
        return $this->fechas;
    }

    public function setFechas(?string $fechas): self
    {
        $this->fechas = $fechas;

        return $this;
    }

    public function getTurno(): ?string
    {
        return $this->turno;
    }

    public function setTurno(string $turno): self
    {
        $this->turno = $turno;

        return $this;
    }
}
