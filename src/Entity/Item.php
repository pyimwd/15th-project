<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Category;
use App\Entity\Collecting;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2, max=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(min=15)
     */
    private $synopsis;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(type="integer")
     */
    private $chapters;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(type="integer")
     */
    private $volumes_or_episodes;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $start_date;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $end_date;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     * @Assert\Url
     */
    private $image_url;

    /**
     * @ORM\ManyToOne(targetEntity=Collecting::class, inversedBy="item")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collecting;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="items")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="item")
     */
    private $users;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getChapters(): ?int
    {
        return $this->chapters;
    }

    public function setChapters(int $chapters): self
    {
        $this->chapters = $chapters;

        return $this;
    }

    public function getVolumesOrEpisodes(): ?int
    {
        return $this->volumes_or_episodes;
    }

    public function setVolumesOrEpisodes(int $volumes_or_episodes): self
    {
        $this->volumes_or_episodes = $volumes_or_episodes;

        return $this;
    }

    public function getStartDate(): ?\DateTimeImmutable
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeImmutable $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeImmutable
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeImmutable $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): self
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function getCollecting(): ?Collecting
    {
        return $this->collecting;
    }

    public function setCollecting(?Collecting $collecting): self
    {
        $this->collecting = $collecting;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addItem($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeItem($this);
        }

        return $this;
    }
}
