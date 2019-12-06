<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
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
 *         "get"={"method"="GET", "access_control"="is_granted('ROLE_ADMIN')"},
 *     },
 *     itemOperations={
 *         "get"={"method"="GET", "access_control"="is_granted('ROLE_ADMIN') or object == user"},
 *         "put"={"method"="PUT", "access_control"="is_granted('ROLE_ADMIN') or object == user"},
 *         "delete"={"method"="DELETE", "access_control"="is_granted('ROLE_ADMIN') or object == user"},
 *     },
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
     *
     * @Groups({"user-read"})
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
    protected $email;

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
    protected $roles = ['ROLE_USER'];

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
    protected $password;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Groups({"user-read", "user-write"})
     */
    protected $highScore;

    /**
     * @var Article[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="author")
     *
     * @Groups({"user-read", "user-write"})
     */
    protected $articles;

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
        $email = strtolower($email);

        $this->email = $email;
        $this->username = $email;

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

    /**
     * @return int|null
     */
    public function getHighScore(): ?int
    {
        return $this->highScore;
    }

    /**
     * @param int|null $highScore
     */
    public function setHighScore(?int $highScore): self
    {
        $this->highScore = $highScore;

        return $this;
    }

    /**
     * @return Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    /**
     * @param Article[] $articles
     */
    public function setArticles($articles): self
    {
        $this->articles = $articles;

        return $this;
    }
}
