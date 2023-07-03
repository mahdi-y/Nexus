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
    /**
     * @var int
     *
     * @ORM\Column(name="id_Q", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private ?int $idQ = null;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre_Q", type="text", length=65535, nullable=false)
     */
    private $titreQ;


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
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur")
     * @ORM\JoinColumn(name="id_u", referencedColumnName="id_u")
     */
    private $idU;

    // ...

    public function getIdU(): ?Utilisateur
    {
        return $this->idU;
    }

    public function setIdU(?Utilisateur $idU): self
    {
        $this->idU = $idU;

        return $this;
    }


    public function getIdQ(): ?int
    {
        return $this->idQ;
    }

    public function getTitreQ(): ?string
    {
        return $this->titreQ;
    }

    public function setTitreQ(string $titreQ): static
    {
        $this->titreQ = $titreQ;

        return $this;
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

    public function getdateAjoutQ(): ?\DateTimeInterface
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

    
}
