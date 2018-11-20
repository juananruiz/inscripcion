<?php

namespace App\Entity\Geo;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalaRepository")
 */
class Sala
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $nombre;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $direccion;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $localidad;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $mapa_url;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Geo\Provincia")
     * @var Provincia
     */
    private $provincia;


    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getLocalidad(): string
    {
        return $this->localidad;
    }

    public function setLocalidad(string $localidad): self
    {
        $this->localidad = $localidad;

        return $this;
    }

    public function getMapaUrl(): string
    {
        return $this->mapa_url;
    }

    public function setMapaUrl(string $mapa_url): self
    {
        $this->mapa_url = $mapa_url;

        return $this;
    }

    public function getProvincia(): Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(Provincia $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }
}
