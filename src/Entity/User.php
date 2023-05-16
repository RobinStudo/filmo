<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(
    fields: 'email',
    message: 'Cette adresse email est déjà associée à un compte',
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'Vous devez saisir une adresse e-mail')]
    #[Assert\Email(message: 'Cette adresse ne semble pas valide')]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function eraseCredentials()
    {
    }

    public static function getPasswordConstraints(): array
    {
        return [
            new Assert\NotBlank(message: 'Vous devez saisir un mot de passe'),
            new Assert\Regex(
                pattern: '/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,40}/',
                message: 'Votre mot de passe doit contenir au moins une lettre minuscule et majuscule ainsi qu\'un chiffre et doit contenir entre 8 et 40 caractères',
            ),
            new Assert\NotCompromisedPassword(message: 'Ce mot de passe a fuité')
        ];
    }

    public static function getPictureConstraints(): array
    {
        return [
            new Assert\File(
                maxSize: '2M',
                maxSizeMessage: 'La taille maximum est de {{ limit }}{{ suffix }}',
                extensions: ['jpeg', 'jpg', 'svg', 'png'],
                extensionsMessage: 'Les formats autorisés sont JP(E)G, PNG et SVG',
            )
        ];
    }
}
