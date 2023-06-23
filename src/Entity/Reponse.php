<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse", indexes={@ORM\Index(name="fk_id_u", columns={"Id_U"}), @ORM\Index(name="fk_id_q", columns={"Id_Q"})})
 * @ORM\Entity
 */
class Reponse
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_R", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idR;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu_R", type="text", length=65535, nullable=false)
     */
    private $contenuR;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Ajout_R", type="date", nullable=false)
     */
    private $dateAjoutR;

    /**
     * @var int
     *
     * @ORM\Column(name="Vote_R", type="integer", nullable=false)
     */
    private $voteR = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="Etat_R", type="integer", nullable=false)
     */
    private $etatR = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="Signale_R", type="integer", nullable=false)
     */
    private $signaleR = '0';

    /**
     * @var \Question
     *
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_Q", referencedColumnName="Id_Q")
     * })
     */
    private $idQ;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_U", referencedColumnName="Id_U")
     * })
     */
    private $idU;

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
