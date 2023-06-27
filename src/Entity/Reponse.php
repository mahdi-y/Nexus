<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReponseRepository;
use DateTime;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id_R", type="integer", nullable=false)
     * @Groups("reponses")
     */
    private ?int $idR = null;

    /**
     * @ORM\Column(length=150)
     * @Groups("reponses")
     */
    #[Assert\NotBlank(message: "Le contenu est obligatoire!")]
    private ?string $contenuR = null;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("reponses")
     */
    private ?DateTime $dateAjoutR = null;

    /**
     * @ORM\Column(type="integer")
     * @Groups("reponses")
     */
    private ?int $voteR = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups("reponses")
     */
    private ?int $etatR = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups("reponses")
     */
    private ?int $signaleR = 0;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class)
     * @ORM\JoinColumn(name="Id_Q", referencedColumnName="id_Q", nullable=true)
     * @Groups("reponses")
     */
    private ?Question $idQ = null;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class)
     * @ORM\JoinColumn(name="id_u", referencedColumnName="id_u", nullable=true)
     * @Groups("reponses")
     */
    private ?Utilisateur $idU = null;

    public function getIdR(): ?int
    {
        return $this->idR;
    }

    public function getContenuR(): ?string
    {
        return $this->contenuR;
    }

    public function setContenuR(string $contenuR): self
    {
        $this->contenuR = $contenuR;

        return $this;
    }

    public function getDateAjoutR(): ?DateTime
    {
        return $this->dateAjoutR;
    }

    public function setDateAjoutR(DateTime $dateAjoutR): self
    {
        $this->dateAjoutR = $dateAjoutR;

        return $this;
    }

    public function getVoteR(): ?int
    {
        return $this->voteR;
    }

    public function setVoteR(int $voteR): self
    {
        $this->voteR = $voteR;

        return $this;
    }

    public function getEtatR(): ?int
    {
        return $this->etatR;
    }

    public function setEtatR(int $etatR): self
    {
        $this->etatR = $etatR;

        return $this;
    }

    public function getSignaleR(): ?int
    {
        return $this->signaleR;
    }

    public function setSignaleR(int $signaleR): self
    {
        $this->signaleR = $signaleR;

        return $this;
    }

    public function getIdQ(): ?Question
    {
        return $this->idQ;
    }

    public function setIdQ(?Question $idQ): self
    {
        $this->idQ = $idQ;

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
}
