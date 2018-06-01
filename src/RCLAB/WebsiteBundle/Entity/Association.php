<?php

namespace RCLAB\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Association
 *
 * @ORM\Table(name="Association")
 * @ORM\Entity(repositoryClass="RCLAB\WebsiteBundle\Repository\AssociationRepository")
 */
class Association
{
    /**
     * @var int
     *
     * @ORM\Column(name="idAssociation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="FacebookAsso", type="string", length=1000, nullable=true)
     */
    private $facebookAsso;

    /**
     * @var string
     *
     * @ORM\Column(name="LogoAsso", type="string", nullable=true)
     */
    private $logoAsso;

    /**
     * @var string
     *
     * @ORM\Column(name="NumeroPermanence", type="string", length=13, nullable=true)
     */
    private $numeroPermanence;

    /**
     * @var string
     *
     * @ORM\Column(name="HorairesPermanence", type="string", length=120, nullable=true)
     */
    private $horairesPermanence;

    /**
     * @var string
     *
     * @ORM\Column(name="MessageAccueil", type="string", length=255, nullable=true)
     */
    private $messageAccueil;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="ImageFocus", type="string")
     */
    private $imageFocus;

    /**
     * @var string
     *
     * @ORM\Column(name="TexteFocus", type="string", length=255)
     */
    private $texteFocus;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set facebookAsso
     *
     * @param string $facebookAsso
     *
     * @return Association
     */
    public function setFacebookAsso($facebookAsso)
    {
        $this->facebookAsso = $facebookAsso;

        return $this;
    }

    /**
     * Get facebookAsso
     *
     * @return string
     */
    public function getFacebookAsso()
    {
        return $this->facebookAsso;
    }

    /**
     * Set logoAsso
     *
     * @param string $logoAsso
     *
     * @return Association
     */
    public function setLogoAsso($logoAsso)
    {
        $this->logoAsso = $logoAsso;

        return $this;
    }

    /**
     * Get logoAsso
     *
     * @return string
     */
    public function getLogoAsso()
    {
        return $this->logoAsso;
    }

    /**
     * Set numeroPermanence
     *
     * @param string $numeroPermanence
     *
     * @return Association
     */
    public function setNumeroPermanence($numeroPermanence)
    {
        $this->numeroPermanence = $numeroPermanence;

        return $this;
    }

    /**
     * Get numeroPermanence
     *
     * @return string
     */
    public function getNumeroPermanence()
    {
        return $this->numeroPermanence;
    }

    /**
     * Set horairesPermanence
     *
     * @param string $horairesPermanence
     *
     * @return Association
     */
    public function setHorairesPermanence($horairesPermanence)
    {
        $this->horairesPermanence = $horairesPermanence;

        return $this;
    }

    /**
     * Get horairesPermanence
     *
     * @return string
     */
    public function getHorairesPermanence()
    {
        return $this->horairesPermanence;
    }

    /**
     * Set messageAccueil
     *
     * @param string $messageAccueil
     *
     * @return Association
     */
    public function setMessageAccueil($messageAccueil)
    {
        $this->messageAccueil = $messageAccueil;

        return $this;
    }

    /**
     * Get messageAccueil
     *
     * @return string
     */
    public function getMessageAccueil()
    {
        return $this->messageAccueil;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Association
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageFocus
     *
     * @param string $imageFocus
     *
     * @return Association
     */
    public function setImageFocus($imageFocus)
    {
        $this->imageFocus = $imageFocus;

        return $this;
    }

    /**
     * Get imageFocus
     *
     * @return string
     */
    public function getImageFocus()
    {
        return $this->imageFocus;
    }

    /**
     * Set texteFocus
     *
     * @param string $texteFocus
     *
     * @return Association
     */
    public function setTexteFocus($texteFocus)
    {
        $this->texteFocus = $texteFocus;

        return $this;
    }

    /**
     * Get texteFocus
     *
     * @return string
     */
    public function getTexteFocus()
    {
        return $this->texteFocus;
    }
}
