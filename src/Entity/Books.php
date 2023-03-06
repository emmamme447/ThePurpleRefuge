<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BooksRepository::class)]
class Books
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $publication_name = null;

    #[ORM\Column(length: 255)]
    private ?string $genre = null;


    #[ORM\OneToMany(targetEntity: Reviews::class, mappedBy: 'books')]
    private $reviews;

    #[ORM\OneToMany(targetEntity: Users::class, mappedBy: 'books')]
    private $users;



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

    public function getPublicationName(): ?\DateTimeInterface
    {
        return $this->publication_name;
    }

    public function setPublicationName(\DateTimeInterface $publication_name): self
    {
        $this->publication_name = $publication_name;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }
}
