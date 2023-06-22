<?php

namespace App\Entity;

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
     * @ORM\Column(name="Titre_Q", type="text", length=65535, nullable=false)
     */
    private $titreQ;

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


}
