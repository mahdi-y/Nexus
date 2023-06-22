<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_U", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idU;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_U", type="string", length=20, nullable=false)
     */
    private $nomU;

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
     * @var int
     *
     * @ORM\Column(name="Role_U", type="integer", nullable=false)
     */
    private $roleU = '0';

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


}
