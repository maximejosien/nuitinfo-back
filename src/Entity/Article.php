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
 *     normalizationContext={"groups"={"article-read"}},
 *     denormalizationContext={"groups"={"article-write"}},
 *     collectionOperations={
 *         "post"={"method"="POST", "access_control"="is_granted('ROLE_ADMIN') or object.getAuthor() == user"},
 *         "get"={"method"="GET", "access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *     },
 *     itemOperations={
 *         "get"={"method"="GET", "access_control"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"},
 *         "put"={"method"="PUT", "access_control"="is_granted('ROLE_ADMIN') or object.getAuthor() == user"},
 *         "delete"={"method"="DELETE", "access_control"="is_granted('ROLE_ADMIN') or object.getAuthor() == user"},
 *     },
 * )
 *
 * @ApiFilter(SearchFilter::class, properties={
 *     "wording": "ipartial",
 *     "category": "ipartial",
 *     "content": "ipartial",
 * })
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"article-read"})
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"article-read", "article-write"})
     */
    protected $wording;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     *
     * @Groups({"article-read", "article-write"})
     */
    protected $content;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"article-read", "article-write"})
     */
    protected $link;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"article-read", "article-write"})
     */
    protected $teaser;

    /**
     * @var array|null
     *
     * @ORM\Column(type="json_array", nullable=true)
     *
     * @Groups({"article-read", "article-write"})
     */
    protected $sources;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     *
     * @Groups({"article-read", "article-write"})
     */
    protected $urlImage;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(type="datetime")
     *
     * @Groups({"article-read"})
     */
    protected $created;

    /**
     * @var User|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
     *
     * @Groups({"article-read", "article-write"})
     */
    protected $author;

    /**
     * @var Category|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     *
     * @Groups({"article-read", "article-write"})
     */
    protected $category;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWording(): ?string
    {
        return $this->wording;
    }

    /**
     * @param string|null $wording
     */
    public function setWording(?string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     */
    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTeaser(): ?string
    {
        return $this->teaser;
    }

    /**
     * @param string|null $teaser
     */
    public function setTeaser(?string $teaser): void
    {
        $this->teaser = $teaser;
    }

    /**
     * @return array|null
     */
    public function getSources(): ?array
    {
        return $this->sources;
    }

    /**
     * @param array|null $sources
     */
    public function setSources(?array $sources): self
    {
        $this->sources = $sources;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrlImage(): ?string
    {
        return $this->urlImage;
    }

    /**
     * @param string|null $urlImage
     */
    public function setUrlImage(?string $urlImage): self
    {
        $this->urlImage = $urlImage;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime|null $created
     * @return $this
     */
    public function setCreated(?\DateTime $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User|null $author
     * @return $this
     */
    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     * @return $this
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function __toString() {
        return $this->wording;
    }
}
