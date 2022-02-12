<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Collecting;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserCollectingRepository;

/**
 * @ORM\Entity(repositoryClass=UserCollectingRepository::class)
 */
class UserCollecting
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userCollectings")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Collecting::class, inversedBy="userCollectings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collecting;

    public function __toString()
    {
        return (string) $this->user;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
}
