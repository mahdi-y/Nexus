<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReponseRepository;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idR = null;

    #[ORM\Column(length: 150)]
    private ?string $contenuR = null;

    #[ORM\Column]
    private ?DateTime $dateAjoutR = null;

    #[ORM\Column]
    private ?int $voteR = 0;

    #[ORM\Column]
    private ?int $etatR = 0;

    #[ORM\Column]
    private ?int $signaleR = 0;

    #[ORM\ManyToOne(inversedBy: 'Reponses')]
    private ?Question $idQ = null;

    #[ORM\ManyToOne(inversedBy: 'Reponses')]
    private ?Utilisateur $idU = null;

    public function getIdR(): ?int
    {
        return $this->idR;
    }

    public function getContenuR(): ?string
    {
        return $this->contenuR;
    }

    public function setContenuR(string $contenuR): static
    {
        $this->contenuR = $contenuR;

        return $this;
    }

    public function getDateAjoutR(): ?\DateTimeInterface
    {
        return $this->dateAjoutR;
    }

    public function setDateAjoutR(\DateTimeInterface $dateAjoutR): static
    {
        $this->dateAjoutR = $dateAjoutR;

        return $this;
    }

    public function getVoteR(): ?int
    {
        return $this->voteR;
    }

    public function setVoteR(int $voteR): static
    {
        $this->voteR = $voteR;

        return $this;
    }

    public function getEtatR(): ?int
    {
        return $this->etatR;
    }

    public function setEtatR(int $etatR): static
    {
        $this->etatR = $etatR;

        return $this;
    }

    public function getSignaleR(): ?int
    {
        return $this->signaleR;
    }

    public function setSignaleR(int $signaleR): static
    {
        $this->signaleR = $signaleR;

        return $this;
    }

    public function getIdQ(): ?Question
    {
        return $this->idQ;
    }

    public function setIdQ(?Question $idQ): static
    {
        $this->idQ = $idQ;

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
