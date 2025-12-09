<?php

namespace App\Entity;

use App\Repository\ConsoleRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ConsoleRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/console/{id}', 
            requirements: ['id' => '\d+'],
            normalizationContext: ['groups' => 'console:all']
        ),
        new GetCollection(
            uriTemplate: '/consoles',
            normalizationContext: ['groups' => 'console:read']),
        new Post(
            uriTemplate: '/console',
            status: 301
        )
    ],
    order: ['id' => 'ASC', 'name' => 'ASC'],
    paginationEnabled: true
)]
class Console
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['console:all'])]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Groups(['console:read', 'console:all', 'game:all', 'game:read'])]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    #[Groups(['console:read', 'console:all', 'game:all', 'game:read'])]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    private ?string $manufacturer = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name . " " . $this->manufacturer;
    }
}
