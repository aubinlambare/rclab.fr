<?php

namespace RCLAB\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="Matiere")
 * @ORM\Entity(repositoryClass="RCLAB\WebsiteBundle\Repository\MatiereRepository")
 */
class Matiere
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMatiere", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Matiere", type="string", length=60)
     */
    private $matiere;

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
     * Set matiere
     *
     * @param string $matiere
     *
     * @return Matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get matiere
     *
     * @return string
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Matiere
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
     * @return Matiere
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
     * @return Matiere
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
