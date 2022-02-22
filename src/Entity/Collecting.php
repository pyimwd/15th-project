<?php

namespace App\Entity;

use App\Entity\Item;
use App\Entity\User;
use App\Entity\UserCollecting;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CollectingRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CollectingRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Collecting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min = 2,
     *     max = 255,
     *     minMessage="Collection name must be at least 2 characters.",
     *     maxMessage="Collection name must not exceed 255 characters."
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $modified_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=Item::class, mappedBy="collecting")
     */
    private $item;

    /**
     * @ORM\OneToMany(targetEntity=UserCollecting::class, mappedBy="collecting", orphanRemoval=true)
     */
    private $userCollectings;

    public function __construct()
    {
        $this->item = new ArrayCollection();
        $this->userCollectings = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->modified_at;
    }

    public function setModifiedAt(\DateTimeImmutable $modified_at): self
    {
        $this->modified_at = $modified_at;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(Item $item): self
    {
        if (!$this->item->contains($item)) {
            $this->item[] = $item;
            $item->setCollecting($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->item->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getCollecting() === $this) {
                $item->setCollecting(null);
            }
        }

        return $this;
    }

    // NOTE : Fonction pour auto set createdAt avec pour cela : ajout plus haut de : HasLifecycleCallbacks

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void
    {
        $this->createdAt = new \DateTimeImmutable();

        $this->setModifiedAt(new \DateTimeImmutable());
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable());
        }
    }

    /**
     * @return Collection|UserCollecting[]
     */
    public function getUserCollectings(): Collection
    {
        return $this->userCollectings;
    }

    public function addUserCollecting(UserCollecting $userCollecting): self
    {
        if (!$this->userCollectings->contains($userCollecting)) {
            $this->userCollectings[] = $userCollecting;
            $userCollecting->setCollecting($this);
        }

        return $this;
    }

    public function removeUserCollecting(UserCollecting $userCollecting): self
    {
        if ($this->userCollectings->removeElement($userCollecting)) {
            // set the owning side to null (unless already changed)
            if ($userCollecting->getCollecting() === $this) {
                $userCollecting->setCollecting(null);
            }
        }

        return $this;
    }
}
