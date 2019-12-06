<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"category-read"}},
 *     denormalizationContext={"groups"={"category-write"}},
 *     collectionOperations={
 *         "post"={"method"="POST", "access_control"="is_granted('ROLE_ADMIN')"},
 *         "get"={"method"="GET", "access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *     },
 *     itemOperations={
 *         "get"={"method"="GET", "access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *         "put"={"method"="PUT", "access_control"="is_granted('ROLE_ADMIN')"},
 *         "delete"={"method"="DELETE", "access_control"="is_granted('ROLE_ADMIN')"},
 *     },
 * )
 *
 * @ApiFilter(SearchFilter::class, properties={
 *     "wording": "ipartial",
 *     "color": "exact",
 *     "category": "ipartial",
 *     "content": "ipartial",
 * })
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"category-read"})
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"category-read", "category-write"})
     */
    protected $name;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"category-read", "category-write"})
     */
    protected $color;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     * @return $this
     */
    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function __toString() {
        return $this->name;
    }
}
