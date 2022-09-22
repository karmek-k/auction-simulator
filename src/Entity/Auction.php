<?php

namespace App\Entity;

use App\Repository\AuctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuctionRepository::class)]
class Auction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Bid>
     */
    #[ORM\OneToMany(mappedBy: 'auction', targetEntity: Bid::class)]
    private Collection $bids;

    #[ORM\Column]
    private ?\DateTimeImmutable $endingDate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $picture = null;

    public function __construct()
    {
        $this->bids = new ArrayCollection();
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

    /**
     * @return Collection<int, Bid>
     */
    public function getBids(): Collection
    {
        return $this->bids;
    }

    public function addBid(Bid $bid): self
    {
        if (!$this->bids->contains($bid)) {
            $this->bids->add($bid);
            $bid->setAuction($this);
        }

        return $this;
    }

    public function removeBid(Bid $bid): self
    {
        if ($this->bids->removeElement($bid)) {
            // set the owning side to null (unless already changed)
            if ($bid->getAuction() === $this) {
                $bid->setAuction(null);
            }
        }

        return $this;
    }

    public function getEndingDate(): ?\DateTimeImmutable
    {
        return $this->endingDate;
    }

    public function setEndingDate(\DateTimeImmutable $endingDate): self
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function highestBid(): ?Bid
    {
        return $this->bids->first() ?: null;
    }
}
