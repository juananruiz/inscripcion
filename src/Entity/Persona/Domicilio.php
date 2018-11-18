<?php

namespace App\Entity\Persona;

use App\Entity\Geo\Provincia;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Domicilio
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private $via;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var int
     */
    private $numero;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @var int
     */
    private $codigoPostal;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @var string
     */
    private $localidad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Geo\Provincia")
     * @var Provincia
     */
    private $provincia;


    public function getId(): int
    {
        return $this->id;
    }

    public function getVia(): string
    {
        return $this->via;
    }

    public function setVia(string $via): self
    {
        $this->via = $via;

        return $this;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCodigoPostal(): int
    {
        return $this->codigoPostal;
    }

    public function setCodigoPostal(int $codigoPostal): self
    {
        $this->codigoPostal = $codigoPostal;

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
