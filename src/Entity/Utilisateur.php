<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Scheb\TwoFactorBundle\Model\Google\TwoFactorInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface, TwoFactorInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_U", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private ?int $idU = null;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_U", type="string", length=20, nullable=false)
     */
    private $nomU;

    /**
     * @var string
     *
     * @ORM\Column(name="authcode", type="string",nullable=false)
     */
    private $authcode;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom_U", type="string", length=20, nullable=false)
     */
    private $prenomU;

    /**
     * @var string
     *
     * @ORM\Column(name="Email_U", type="string", length=50, nullable=false)
     */
    private $emailU;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Naissance_U", type="date", nullable=false)
     */
    private $dateNaissanceU;

    /**
     * @var string
     *
     * @ORM\Column(name="Sexe_U", type="string", length=20, nullable=false)
     */
    private $sexeU;

    /**
     * @var string
     *
     * @ORM\Column(name="Mdp", type="string", length=64, nullable=false)
     */
    private $mdp;

    /**
     * @var string
     *
     * @Assert\NotBlank(groups={"registration"})
     * @Groups({"registration"})
     */
    private ?string $plainPassword = null;

    /**
     * @var int
     *
     * @ORM\Column(name="Role_U", type="integer", nullable=false)
     */
    private $roleU = '0';

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var int
     *
     * @ORM\Column(name="Verifie_U", type="integer", nullable=false)
     */
    private $verifieU = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="Actif_U", type="integer", nullable=false)
     */
    private $actifU = '0';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Question", mappedBy="idU")
     */
    private Collection $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

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

    public function getDateNaissanceU(): ?\DateTimeInterface
    {
        return $this->dateNaissanceU;
    }

    public function setDateNaissanceU(\DateTimeInterface $dateNaissanceU): self
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

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

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

    // Implement methods from UserInterface and PasswordAuthenticatedUserInterface

    public function getRoles()
    {
        // Define the roles for your user based on the $roleU property
        if ($this->roleU === 1) {
            return ['ROLE_ADMIN'];
        }

        return ['ROLE_USER'];
    }


    public function getPassword(): string
    {
        return $this->mdp;
    }

    public function getSalt(): ?string
    {
        // Leave this empty if you're using bcrypt for password hashing
        // Symfony's built-in password encoder automatically handles the salt
        return null;
    }

    public function getUsername(): string
    {
        return $this->emailU;
    }

    public function eraseCredentials()
    {
        // Implement this method if you have any sensitive information to clear
        // For example, if you have a plain-text password property, you can set it to null here
    }
    public function getUserIdentifier()
    {
        return $this->emailU;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setIdU($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getIdU() === $this) {
                $question->setIdU(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->prenomU;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function isEmailAuthEnabled(): bool
    {
        return true;
    }

    public function getEmailAuthRecipient(): string
    {
        return $this->emailU;
    }

    public function getEmailAuthCode(): ?string
    {
        if (null === $this->authcode) {
            throw new \LogicException('The email authentication code was not sent!');
        }

        return $this->authcode;
    }

    public function setEmailAuthCode(string $authCode): void
    {
        $this->authcode = $authCode;
    }

    public function isGoogleAuthenticatorEnabled(): bool
    {
        return null !== $this->authcode;
    }

    public function getGoogleAuthenticatorUsername(): string
    {
        return $this->emailU;
    }

    public function getGoogleAuthenticatorSecret(): ?string
    {
        return $this->authcode;
    }

    public function setGoogleAuthenticatorSecret(?string $authCode): void
    {
        $this->authcode = $authCode;
    }
}
