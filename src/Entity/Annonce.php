<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $model = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?float $km = null;

    #[ORM\Column(length: 255)]
    private ?string $fuel = null;

    #[ORM\Column(length: 255)]
    private ?string $imgfile = null;

    #[ORM\Column]
    private ?bool $is_visible = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?Marque $marque = null;

    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?User $author = null;

    #[ORM\Column]
    private ?bool $license = null;

    #[ORM\OneToMany(mappedBy: 'annonces', targetEntity: AnnonceListByUser::class)]
    private Collection $usersFav;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    public function __construct()
    {
        $this->usersFav = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getKm(): ?float
    {
        return $this->km;
    }

    public function setKm(float $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getImgfile(): ?string
    {
        return $this->imgfile;
    }

    public function setImgfile(string $imgfile): self
    {
        $this->imgfile = $imgfile;

        return $this;
    }

    public function getIsVisible(): ?bool
    {
        return $this->is_visible;
    }

    public function setIsVisible(bool $is_visible): self
    {
        $this->is_visible = $is_visible;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function isLicense(): ?bool
    {
        return $this->license;
    }

    public function setLicense(bool $license): self
    {
        $this->license = $license;

        return $this;
    }

    /**
     * @return Collection<int, AnnonceListByUser>
     */
    public function getUsersFav(): Collection
    {
        return $this->usersFav;
    }

    public function addUsersFav(AnnonceListByUser $usersFav): self
    {
        if (!$this->usersFav->contains($usersFav)) {
            $this->usersFav->add($usersFav);
            $usersFav->setAnnonces($this);
        }

        return $this;
    }

    public function removeUsersFav(AnnonceListByUser $usersFav): self
    {
        if ($this->usersFav->removeElement($usersFav)) {
            // set the owning side to null (unless already changed)
            if ($usersFav->getAnnonces() === $this) {
                $usersFav->setAnnonces(null);
            }
        }

        return $this;
    }

    /**
     * @param User $user
     * @return boolean
     */
    public function isUsersFav (User $user): bool
    {
        foreach($this->usersFav as $usersFav) {
            if($usersFav ->getUsers() === $user) return true;
        }
        return false;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
}
