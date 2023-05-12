<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'Vous devez saisir un prénom')]
    #[Assert\Length(
        min: 2,
        max: 60,
        minMessage: 'Le prénom doit contenir au minimum {{ limit }} caractères',
        maxMessage: 'Le prénom doit contenir au maximum {{ limit }} caractères',
    )]
    #[ORM\Column(length: 60)]
    private ?string $firstname = null;

    #[Assert\NotBlank(message: 'Vous devez saisir un nom')]
    #[Assert\Length(
        min: 2,
        max: 60,
        minMessage: 'Le nom doit contenir au minimum {{ limit }} caractères',
        maxMessage: 'Le nom doit contenir au maximum {{ limit }} caractères',
    )]
    #[ORM\Column(length: 60)]
    private ?string $lastname = null;

    #[Assert\LessThan(
        value: 'today',
        message: 'Vous ne pouvez pas prédire l\'avenir',
    )]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?DateTimeInterface $birthdate = null;

    #[Assert\NotBlank(message: 'Vous devez choisir une nationalité')]
    #[ORM\Column(length: 2)]
    private ?string $nationality = null;

    #[ORM\ManyToMany(targetEntity: Movie::class, mappedBy: 'actors')]
    private Collection $actMovies;

    #[ORM\OneToMany(mappedBy: 'person', targetEntity: Crew::class, orphanRemoval: true)]
    private Collection $dutyCrews;

    public function __construct()
    {
        $this->actMovies = new ArrayCollection();
        $this->dutyCrews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthdate(): ?DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getActMovies(): Collection
    {
        return $this->actMovies;
    }

    public function addActMovie(Movie $actMovie): self
    {
        if (!$this->actMovies->contains($actMovie)) {
            $this->actMovies->add($actMovie);
            $actMovie->addActor($this);
        }

        return $this;
    }

    public function removeActMovie(Movie $actMovie): self
    {
        if ($this->actMovies->removeElement($actMovie)) {
            $actMovie->removeActor($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Crew>
     */
    public function getDutyCrews(): Collection
    {
        return $this->dutyCrews;
    }

    public function addDutyCrew(Crew $dutyCrew): self
    {
        if (!$this->dutyCrews->contains($dutyCrew)) {
            $this->dutyCrews->add($dutyCrew);
            $dutyCrew->setPerson($this);
        }

        return $this;
    }

    public function removeDutyCrew(Crew $dutyCrew): self
    {
        if ($this->dutyCrews->removeElement($dutyCrew)) {
            // set the owning side to null (unless already changed)
            if ($dutyCrew->getPerson() === $this) {
                $dutyCrew->setPerson(null);
            }
        }

        return $this;
    }
}
