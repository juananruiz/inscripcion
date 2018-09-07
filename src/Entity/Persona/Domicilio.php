<?php

namespace App\Entity\Persona;

use App\Entity\Geo\{
    Localidad, Provincia
};
use Doctrine\ORM\Mapping as ORM;

class Domicilio
{
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
     * @ORM\Column(type="int", nullable=false)
     * @var int
     */
    private $codigoPostal;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Geo\Localidad")
     * @var Localidad
     */
    private $localidad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Geo|Provincia")
     * @var Provincia
     */
    private $provincia;

    /**
     * @return string
     */
    public function getVia(): string
    {
        return $this->via;
    }

    /**
     * @param string $via
     * @return Domicilio
     */
    public function setVia(string $via): self
    {
        $this->via = $via;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumero(): int
    {
        return $this->numero;
    }

    /**
     * @param int $numero
     * @return Domicilio
     */
    public function setNumero(int $numero): self
    {
        $this->numero = $numero;
        return $this;
    }

    /**
     * @return int
     */
    public function getCodigoPostal(): int
    {
        return $this->codigoPostal;
    }

    /**
     * @param int $codigoPostal
     * @return Domicilio
     */
    public function setCodigoPostal(int $codigoPostal): self
    {
        $this->codigoPostal = $codigoPostal;
        return $this;
    }

    /**
     * @return Localidad
     */
    public function getLocalidad(): Localidad
    {
        return $this->localidad;
    }

    /**
     * @param Localidad $localidad
     */
    public function setLocalidad(Localidad $localidad): void
    {
        $this->localidad = $localidad;
    }

    /**
     * @return Provincia
     */
    public function getProvincia(): Provincia
    {
        return $this->provincia;
    }

    /**
     * @param Provincia $provincia
     */
    public function setProvincia(Provincia $provincia): void
    {
        $this->provincia = $provincia;
    }
}
