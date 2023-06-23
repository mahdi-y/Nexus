<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question", indexes={@ORM\Index(name="fk_id_u2", columns={"Id_U"})})
 * @ORM\Entity
 */
class Question
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Q", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idQ;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu_Q", type="text", length=65535, nullable=false)
     */
    private $contenuQ;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_Q", type="string", length=40, nullable=false)
     */
    private $typeQ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Ajout_Q", type="date", nullable=false)
     */
    private $dateAjoutQ;

    /**
     * @var int
     *
     * @ORM\Column(name="Vote_Q", type="integer", nullable=false)
     */
    private $voteQ = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="Signale_Q", type="integer", nullable=false)
     */
    private $signaleQ = '0';

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_U", referencedColumnName="Id_U")
     * })
     */
    private $idU;

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
