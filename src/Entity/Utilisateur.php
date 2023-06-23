<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use DateTime;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idU = null;

    #[ORM\Column(length: 150)]
    private ?string $nomU = null;

    #[ORM\Column(length: 150)]
    private ?string $prenomU = null;

    #[ORM\Column(length: 150)]
    private ?string $emailU = null;

    #[ORM\Column]
    private ?DateTime $dateNaissanceU = null;

    #[ORM\Column(length: 150)]
    private ?string $sexeU = null;

    #[ORM\Column]
    private ?int $roleU = 0;

    #[ORM\Column]
    private ?string $Mdp = null;

    #[ORM\Column]
    private ?int $verifieU = 0;

    #[ORM\Column]
    private ?int $actifU = 0;

    public function getIdU(): ?int
    {
        return $this->idU;
    }

    public function getNomU(): ?string
    {
        return $this->nomU;
    }

    public function setNomU(string $nomU): static
    {
        $this->nomU = $nomU;

        return $this;
    }

    public function getPrenomU(): ?string
    {
        return $this->prenomU;
    }

    public function setPrenomU(string $prenomU): static
    {
        $this->prenomU = $prenomU;

        return $this;
    }

    public function getEmailU(): ?string
    {
        return $this->emailU;
    }

    public function setEmailU(string $emailU): static
    {
        $this->emailU = $emailU;

        return $this;
    }

    public function getDateNaissanceU(): ?\DateTimeInterface
    {
        return $this->dateNaissanceU;
    }

    public function setDateNaissanceU(\DateTimeInterface $dateNaissanceU): static
    {
        $this->dateNaissanceU = $dateNaissanceU;

        return $this;
    }

    public function getSexeU(): ?string
    {
        return $this->sexeU;
    }

    public function setSexeU(string $sexeU): static
    {
        $this->sexeU = $sexeU;

        return $this;
    }

    public function getRoleU(): ?int
    {
        return $this->roleU;
    }

    public function setRoleU(int $roleU): static
    {
        $this->roleU = $roleU;

        return $this;
    }
    public function getMpd(): ?string
    {
        return $this->Mdp;
    }

    public function setMdp(string $Mdp): static
    {
        $this->Mdp = $Mdp;

        return $this;
    }

    public function getVerifieU(): ?int
    {
        return $this->verifieU;
    }

    public function setVerifieU(int $verifieU): static
    {
        $this->verifieU = $verifieU;

        return $this;
    }

    public function getActifU(): ?int
    {
        return $this->actifU;
    }

    public function setActifU(int $actifU): static
    {
        $this->actifU = $actifU;

        return $this;
    }
}
