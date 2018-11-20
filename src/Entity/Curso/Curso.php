<?php

namespace App\Entity\Curso;

use App\Entity\Geo\Sala;
use App\Entity\Inscripcion\Inscripcion;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OrderBy({"fechaInicio": "DESC"})
     * @var Sesion[]|ArrayCollection
     */
    private $sesiones;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;


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

    public function getSala(): Sala
    {
        return $this->sala;
    }

    public function setSala(Sala $sala): self
    {
        $this->sala = $sala;

        return $this;
    }

    public function getSesiones(): ArrayCollection
    {
        return $this->sesiones;
    }
}
