<?php

namespace App\Entity\Evento;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EdicionRepository")
 */
class Edicion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evento", inversedBy="ediciones")
     * @var Evento
     */
    private $evento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lugar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $plazas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sesion", mappedBy="edicion")
     * @ORM\OrderBy({"fechaInicio": "DESC"})
     * @var Sesion[]|ArrayCollection
     */
    private $sesiones;


    public function __construct()
    {
        $this->sesiones = new ArrayCollection();
    }


    public function getId():int
    {
        return $this->id;
    }

    public function getLugar(): ?string
    {
        return $this->lugar;
    }

    public function setLugar(?string $lugar): self
    {
        $this->lugar = $lugar;

        return $this;
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

    public function getPlazas(): ?int
    {
        return $this->plazas;
    }

    public function setPlazas(int $plazas): self
    {
        $this->plazas = $plazas;

        return $this;
    }

    /**
     * @return Sesion[]|ArrayCollection
     */
    public function getSesiones(): ArrayCollection
    {
        return $this->sesiones;
    }

    /**
     * @return Evento
     */
    public function getEvento(): Evento
    {
        return $this->evento;
    }

    /**
     * @param Evento $evento
     * @return Edicion
     */
    public function setEvento(Evento $evento): self
    {
        $this->evento = $evento;

        return $this;
    }

}
