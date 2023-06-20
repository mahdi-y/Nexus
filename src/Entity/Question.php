<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\QuestionRepository;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idQ = null;

    #[ORM\Column(length: 150)]
    private ?string $contenuQ = null;

    #[ORM\Column(length: 150)]
    private ?string $typeQ = null;

    #[ORM\Column]
    private ?DateTime $dateAjoutQ = null;

    #[ORM\Column]
    private ?int $voteQ = 0;

    #[ORM\Column]
    private ?int $signaleQ = 0;

    #[ORM\ManyToOne(inversedBy: 'Questions')]
    private ?Utilisateur $idU = null;

    public function getIdQ(): ?int
    {
        return $this->idQ;
    }

    public function getContenuQ(): ?string
    {
        return $this->contenuQ;
    }

    public function setContenuQ(string $contenuQ): static
    {
        $this->contenuQ = $contenuQ;

        return $this;
    }

    public function getTypeQ(): ?string
    {
        return $this->typeQ;
    }

    public function setTypeQ(string $typeQ): static
    {
        $this->typeQ = $typeQ;

        return $this;
    }

    public function getDateAjoutQ(): ?\DateTimeInterface
    {
        return $this->dateAjoutQ;
    }

    public function setDateAjoutQ(\DateTimeInterface $dateAjoutQ): static
    {
        $this->dateAjoutQ = $dateAjoutQ;

        return $this;
    }

    public function getVoteQ(): ?int
    {
        return $this->voteQ;
    }

    public function setVoteQ(int $voteQ): static
    {
        $this->voteQ = $voteQ;

        return $this;
    }

    public function getSignaleQ(): ?int
    {
        return $this->signaleQ;
    }

    public function setSignaleQ(int $signaleQ): static
    {
        $this->signaleQ = $signaleQ;

        return $this;
    }

    public function getIdU(): ?Utilisateur
    {
        return $this->idU;
    }

    public function setIdU(?Utilisateur $idU): static
    {
        $this->idU = $idU;

        return $this;
    }
}
