<?php

namespace RCLAB\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * T_Demande
 *
 * @ORM\Table(name="T_Demande")
 * @ORM\Entity(repositoryClass="RCLAB\WebsiteBundle\Repository\T_DemandeRepository")
 */
class T_Demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="idTDemande", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="TypeDemande", type="string", length=30)
     */
    private $typeDemande;

    /**
     * @var int
     *
     * @ORM\Column(name="Tri", type="smallint", nullable=true)
     */
    private $tri;

    /**
     * @var string
     *
     * @ORM\Column(name="Couleur", type="string", length=15, nullable=true)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="Icone", type="blob", nullable=true)
     */
    private $icone;

    /**
     * @var bool
     *
     * @ORM\Column(name="Historique", type="boolean")
     */
    private $historique;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set typeDemande
     *
     * @param string $typeDemande
     *
     * @return T_Demande
     */
    public function setTypeDemande($typeDemande)
    {
        $this->typeDemande = $typeDemande;

        return $this;
    }

    /**
     * Get typeDemande
     *
     * @return string
     */
    public function getTypeDemande()
    {
        return $this->typeDemande;
    }

    /**
     * Set tri
     *
     * @param integer $tri
     *
     * @return T_Demande
     */
    public function setTri($tri)
    {
        $this->tri = $tri;

        return $this;
    }

    /**
     * Get tri
     *
     * @return int
     */
    public function getTri()
    {
        return $this->tri;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return T_Demande
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set icone
     *
     * @param string $icone
     *
     * @return T_Demande
     */
    public function setIcone($icone)
    {
        $this->icone = $icone;

        return $this;
    }

    /**
     * Get icone
     *
     * @return string
     */
    public function getIcone()
    {
        return $this->icone;
    }

    /**
     * Set historique
     *
     * @param boolean $historique
     *
     * @return T_Demande
     */
    public function setHistorique($historique)
    {
        $this->historique = $historique;

        return $this;
    }

    /**
     * Get historique
     *
     * @return bool
     */
    public function getHistorique()
    {
        return $this->historique;
    }
}
