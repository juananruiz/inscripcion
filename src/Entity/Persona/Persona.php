<?php

namespace App\Entity\Persona;

use App\Entity\Inscripcion\Inscripcion;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonaRepository")
 */
class Persona
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $correo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clave;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Persona\Domicilio")
     * @var Domicilio
     */
    private $domicilio;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Persona\Perfil", mappedBy="persona", cascade={"persist", "remove"})
     */
    private $perfil;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscripcion\Inscripcion", mappedBy="persona")
     * @ORM\OrderBy({"fechaAlta": "DESC"})
     * @var Inscripcion[]|ArrayCollection
     */
    private $inscripciones;


    public function __construct()
    {
        $this->inscripciones = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Persona
     */
    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     * @return Persona
     */
    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    /**
     * @param string $correo
     * @return Persona
     */
    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getClave(): ?string
    {
        return $this->clave;
    }


    /**
     * @param string $clave
     * @return Persona
     */
    public function setClave(string $clave): self
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * @return Domicilio
     */
    public function getDomicilio(): Domicilio
    {
        return $this->domicilio;
    }

    /**
     * @param Domicilio $domicilio
     * @return Persona;
     */
    public function setDomicilio(Domicilio $domicilio): self
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    public function getPerfil(): ?Perfil
    {
        return $this->perfil;
    }

    public function setPerfil(?Perfil $perfil): self
    {
        $this->perfil = $perfil;

        // set (or unset) the owning side of the relation if necessary
        $newPersona = $perfil === null ? null : $this;
        if ($newPersona !== $perfil->getPersona()) {
            $perfil->setPersona($newPersona);
        }

        return $this;
    }

    public function getInscripciones(): ?ArrayCollection
    {
        return $this->inscripciones;
    }
}
