<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $idU = null;

    /**
     * @ORM\Column(length=150)
     */
    private ?string $nomU = null;

    /**
     * @ORM\Column(length=150)
     */
    private ?string $prenomU = null;

    /**
     * @ORM\Column(length=150)
     */
    private ?string $emailU = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $mdp = null;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTime $dateNaissanceU = null;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private ?string $sexeU = null;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $roleU = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $verifieU = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $actifU = 0;

    public function getIdU(): ?int
    {
        return $this->idU;
    }

    public function getNomU(): ?string
    {
        return $this->nomU;
    }

    public function setNomU(string $nomU): self
    {
        $this->nomU = $nomU;

        return $this;
    }

    public function getPrenomU(): ?string
    {
        return $this->prenomU;
    }

    public function setPrenomU(string $prenomU): self
    {
        $this->prenomU = $prenomU;

        return $this;
    }

    public function getEmailU(): ?string
    {
        return $this->emailU;
    }

    public function setEmailU(string $emailU): self
    {
        $this->emailU = $emailU;

        return $this;
    }

    public function getMdp(): ?int
    {
        return $this->mdp;
    }

    public function setMdp(int $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getDateNaissanceU(): ?DateTime
    {
        return $this->dateNaissanceU;
    }

    public function setDateNaissanceU(DateTime $dateNaissanceU): self
    {
        $this->dateNaissanceU = $dateNaissanceU;

        return $this;
    }

    public function getSexeU(): ?string
    {
        return $this->sexeU;
    }

    public function setSexeU(string $sexeU): self
    {
        $this->sexeU = $sexeU;

        return $this;
    }

    public function getRoleU(): ?int
    {
        return $this->roleU;
    }

    public function setRoleU(int $roleU): self
    {
        $this->roleU = $roleU;

        return $this;
    }

    public function getVerifieU(): ?int
    {
        return $this->verifieU;
    }

    public function setVerifieU(int $verifieU): self
    {
        $this->verifieU = $verifieU;

        return $this;
    }

    public function getActifU(): ?int
    {
        return $this->actifU;
    }

    public function setActifU(int $actifU): self
    {
        $this->actifU = $actifU;

        return $this;
    }
}
