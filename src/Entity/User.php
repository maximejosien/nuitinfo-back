<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"user-read"}},
 *     denormalizationContext={"groups"={"user-write"}},
 *     collectionOperations={
 *         "post"={"method"="POST", "access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *     },
 *     itemOperations={}
 * )
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(type="string", unique=true)
     *
     * @Groups({"user-read", "user-write"})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Groups({"user-read", "user-write"})
     */
    protected $username;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     *
     * @Groups({"user-read"})
     */
    private $roles = [];
    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @var string The hashed password
     * @ORM\Column(type="string")
     *
     * @Groups({"user-write"})
     */
    private $password;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        return $this->getSalt();
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username): self
    {
        $this->username = $this->email;

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
