<?php

namespace App\Entity\Evento;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventoRepository")
 */
class Evento
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
     * @ORM\Column(type="string", length=50)
     */
    private $duracionEstimada;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Edicion", mappedBy="evento")
     * @ORM\OrderBy({"fechaInicio": "DESC"})
     * @var Edicion[]|ArrayCollection
     */
    private $ediciones;

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
        $this->ediciones = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Edicion[]|ArrayCollection
     */
    public function getEdiciones(): ArrayCollection
    {
        return $this->ediciones;
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

    /**
     * @return mixed
     */
    public function getDuracionEstimada()
    {
        return $this->duracionEstimada;
    }

    /**
     * @param mixed $duracionEstimada
     */
    public function setDuracionEstimada($duracionEstimada): void
    {
        $this->duracionEstimada = $duracionEstimada;
    }
}
