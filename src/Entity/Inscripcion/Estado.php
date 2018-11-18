<?php

namespace App\Entity\Inscripcion;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscripcionEstadoRepository")
 * @ORM\Table(name="Inscripcion")
 */
class Estado
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $claseCSS;


    public function getId(): int
    {
        return $this->id;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getClaseCSS(): string
    {
        return $this->claseCSS;
    }

    public function setClaseCSS(string $claseCSS): self
    {
        $this->claseCSS = $claseCSS;

        return $this;
    }
}
