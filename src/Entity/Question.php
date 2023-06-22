<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\QuestionRepository;
use DateTime;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_Q", type="integer", nullable=false)
     * @Groups("questions")
     */
    private ?int $id_Q = null;

    /**
     * @ORM\Column(length=150)
     * @Groups("questions")
     */
    private ?string $contenuQ = null;

    /**
     * @ORM\Column(length=150)
     * @Groups("questions")
     */
    private ?string $typeQ = null;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("questions")
     */
    private ?DateTime $dateAjoutQ = null;

    /**
     * @ORM\Column(type="integer")
     * @Groups("questions")
     */
    private ?int $voteQ = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups("questions")
     */
    private ?int $signaleQ = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class)
     * @ORM\JoinColumn(name="id_u", referencedColumnName="id_u", nullable=true)
     * @Groups("questions")
     */
    private ?Utilisateur $idU = null;


    public function getContenuQ(): ?string
    {
        return $this->contenuQ;
    }

    public function setContenuQ(string $contenuQ): self
    {
        $this->contenuQ = $contenuQ;

        return $this;
    }

    public function getTypeQ(): ?string
    {
        return $this->typeQ;
    }

    public function setTypeQ(string $typeQ): self
    {
        $this->typeQ = $typeQ;

        return $this;
    }

    public function getDateAjoutQ(): ?DateTime
    {
        return $this->dateAjoutQ;
    }

    public function setDateAjoutQ(DateTime $dateAjoutQ): self
    {
        $this->dateAjoutQ = $dateAjoutQ;

        return $this;
    }

    public function getVoteQ(): ?int
    {
        return $this->voteQ;
    }

    public function setVoteQ(int $voteQ): self
    {
        $this->voteQ = $voteQ;

        return $this;
    }

    public function getSignaleQ(): ?int
    {
        return $this->signaleQ;
    }

    public function setSignaleQ(int $signaleQ): self
    {
        $this->signaleQ = $signaleQ;

        return $this;
    }

    public function getIdU(): ?Utilisateur
    {
        return $this->idU;
    }

    public function setIdU(?Utilisateur $idU): self
    {
        $this->idU = $idU;

        return $this;
    }

    public function getid_Q(): ?int
    {
        return $this->id_Q;
    }
}
