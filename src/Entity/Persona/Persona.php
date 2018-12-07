<?php

namespace App\Entity\Persona;

use App\Entity\Inscripcion\Inscripcion;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonaRepository")
 * @UniqueEntity("correo", message="Ya existe un usuario con este correo en nuestra web")
 */
class Persona implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email
     */
    private $correo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $clave;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Persona\Domicilio", cascade={"persist"})
     * @var Domicilio
     */
    private $domicilio;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @var string
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscripcion\Inscripcion", mappedBy="persona")
     * @ORM\OrderBy({"fechaAlta": "DESC"})
     * @var Inscripcion[]|ArrayCollection
     */
    private $inscripciones;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $telefono;


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


    public function getDomicilio(): ?Domicilio
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

    public function getInscripciones(): ?ArrayCollection
    {
        return $this->inscripciones;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->getId(),
            $this->getCorreo(),
            $this->getClave(),
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->correo,
            $this->clave,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }


    public function getRoles(): string
    {
        $roles = $this->roles;

        // guarantees that a user always has at least one role for security
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    /**
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     */
    public function getPassword(): string
    {
        return $this->getClave();
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername(): string
    {
        return $this->getCorreo();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }
}
