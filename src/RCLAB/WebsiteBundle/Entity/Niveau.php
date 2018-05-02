<?php

namespace RCLAB\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niveau
 *
 * @ORM\Table(name="Niveau")
 * @ORM\Entity(repositoryClass="RCLAB\WebsiteBundle\Repository\NiveauRepository")
 */
class Niveau
{
    /**
     * @var int
     *
     * @ORM\Column(name="idNiveau", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Niveau", type="string", length=15)
     */
    private $niveau;

    // /**
    //  * @var int
    //  *
    //  * @ORM\Column(name="Tri", type="smallint", nullable=true)
    //  */
    // private $tri;

    /**
     * @var string
     *
     * @ORM\Column(name="Couleur", type="string", length=15, nullable=true)
     */
    private $couleur;


    /**
     * @var string
     *
     * @ORM\Column(name="Icone", type="string", nullable=true)
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
     * Set niveau
     *
     * @param string $niveau
     *
     * @return Niveau
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set tri
     *
     * @param integer $tri
     *
     * @return Niveau
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
     * @return Niveau
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
     * @return Niveau
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
     * @return Niveau
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
