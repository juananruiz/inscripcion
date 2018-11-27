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
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $via;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $numero;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $codigoPostal;

    /**
     * @ORM\Column(type="string", nullable=true)
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

    public function getVia(): ?string
    {
        return $this->via;
    }

    public function setVia(?string $via): self
    {
        $this->via = $via;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCodigoPostal(): ?string
    {
        return $this->codigoPostal;
    }

    public function setCodigoPostal(?string $codigoPostal): self
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    public function getLocalidad(): ?string
    {
        return $this->localidad;
    }

    public function setLocalidad(?string $localidad): self
    {
        $this->localidad = $localidad;

        return $this;
    }

    public function getProvincia(): ?Provincia
    {
        return $this->provincia;
    }

    public function setProvincia(Provincia $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }
}
