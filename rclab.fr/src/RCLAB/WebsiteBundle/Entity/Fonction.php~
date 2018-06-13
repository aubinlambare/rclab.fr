<?php

namespace RCLAB\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fonction
 *
 * @ORM\Table(name="Fonction")
 * @ORM\Entity(repositoryClass="RCLAB\WebsiteBundle\Repository\FonctionRepository")
 */
class Fonction
{
    /**
     * @var int
     *
     * @ORM\Column(name="idFonction", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Fonction", type="string", length=20)
     */
    private $fonction;

    /**
     * @var int
     *
     * @ORM\Column(name="Tri", type="smallint")
     */
    private $tri;


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
     * Set fonction
     *
     * @param string $fonction
     *
     * @return Fonction
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set tri
     *
     * @param integer $tri
     *
     * @return Fonction
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
}
