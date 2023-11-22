<?php

namespace App\Entity;

use App\Repository\OpeningTimeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OpeningTimeRepository::class)]
class OpeningTime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Assert\NotBlank()]
    #[Assert\Length(
        min: 2,
        max: 10,
    )]
    private ?string $day = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $openAM = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $closeAM = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $openPM = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $closePM = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function getOpenAM(): ?\DateTimeInterface
    {
        return $this->openAM;
    }

    public function setOpenAM(?\DateTimeInterface $openAM): static
    {
        $this->openAM = $openAM;

        return $this;
    }

    public function getCloseAM(): ?\DateTimeInterface
    {
        return $this->closeAM;
    }

    public function setCloseAM(?\DateTimeInterface $closeAM): static
    {
        $this->closeAM = $closeAM;

        return $this;
    }

    public function getOpenPM(): ?\DateTimeInterface
    {
        return $this->openPM;
    }

    public function setOpenPM(?\DateTimeInterface $openPM): static
    {
        $this->openPM = $openPM;

        return $this;
    }

    public function getClosePM(): ?\DateTimeInterface
    {
        return $this->closePM;
    }

    public function setClosePM(?\DateTimeInterface $closePM): static
    {
        $this->closePM = $closePM;

        return $this;
    }
}
