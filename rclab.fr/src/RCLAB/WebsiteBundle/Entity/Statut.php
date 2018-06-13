<?php

namespace RCLAB\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statut
 *
 * @ORM\Table(name="Statut")
 * @ORM\Entity(repositoryClass="RCLAB\WebsiteBundle\Repository\StatutRepository")
 */
class Statut
{
    /**
     * @var int
     *
     * @ORM\Column(name="idStatut", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Statut", type="string", length=20, nullable=true)
     */
    private $statut;

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
     * Set statut
     *
     * @param string $statut
     *
     * @return Statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set tri
     *
     * @param integer $tri
     *
     * @return Statut
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
