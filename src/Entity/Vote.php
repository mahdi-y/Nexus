<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idV;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id_u")
     */
    private $IdU;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class)
     * @ORM\JoinColumn(name="question_Id", referencedColumnName="id_Q")
     */
    private $IdQ;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vote_type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    // Getters and setters

    public function getIdV(): ?int
    {
        return $this->idV;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->IdU;
    }

    public function setUtilisateur(?Utilisateur $IdU): self
    {
        $this->IdU = $IdU;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->IdQ;
    }

    public function setQuestion(?Question $IdQ): self
    {
        $this->IdQ = $IdQ;

        return $this;
    }

    public function getVoteType(): ?string
    {
        return $this->vote_type;
    }

    public function setVoteType(string $vote_type): self
    {
        $this->vote_type = $vote_type;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getIdU(): ?Utilisateur
    {
        return $this->IdU;
    }

    public function setIdU(?Utilisateur $IdU): static
    {
        $this->IdU = $IdU;

        return $this;
    }

    public function getIdQ(): ?Question
    {
        return $this->IdQ;
    }

    public function setIdQ(?Question $IdQ): static
    {
        $this->IdQ = $IdQ;

        return $this;
    }
}
