<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\VoteRepository;

/**
 * Vote
 *
 * @ORM\Table(name="vote", indexes={@ORM\Index(name="fk_id_reponse_vote", columns={"id_R"}), @ORM\Index(name="fk_id_utilisateur_vote", columns={"id_U"}), @ORM\Index(name="fk_id_question_vote", columns={"id_Q"})})
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_v", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private ?int $idV = null;

    /**
     * @var string
     *
     * @ORM\Column(name="type_vote", type="string", length=100, nullable=false)
     * @Groups("votes")
     */
    private ?string $typeVote = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="questions")
     * @ORM\JoinColumn(name="id_U", referencedColumnName="id_U")
     * @Groups("votes")
     */
    private ?Utilisateur $idU = null;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class)
     * @ORM\JoinColumn(name="Id_Q", referencedColumnName="id_Q", nullable=true)
     * @Groups("votes")
     */
    private ?Question $idQ = null;

    /**
     * @ORM\ManyToOne(targetEntity=Reponse::class)
     * @ORM\JoinColumn(name="Id_R", referencedColumnName="id_R", nullable=true)
     * @Groups("votes")
     */
    private ?Reponse $idR = null;

    public function getIdV(): ?int
    {
        return $this->idV;
    }

    public function getTypeVote(): ?string
    {
        return $this->typeVote;
    }

    public function setTypeVote(string $typeVote): static
    {
        $this->typeVote = $typeVote;

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

    public function getIdQ(): ?Question
    {
        return $this->idQ;
    }

    public function setIdQ(?Question $idQ): static
    {
        $this->idQ = $idQ;

        return $this;
    }

    public function getIdR(): ?Reponse
    {
        return $this->idR;
    }

    public function setIdR(?Reponse $idR): static
    {
        $this->idR = $idR;

        return $this;
    }
}