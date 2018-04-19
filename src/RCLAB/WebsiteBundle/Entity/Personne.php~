<?php

namespace RCLAB\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Personne
 *
 * @ORM\Table(name="Personne")
 * @ORM\Entity(repositoryClass="RCLAB\WebsiteBundle\Repository\PersonneRepository")
 */
class Personne
{
    /**


     * @var int
     *
     * @ORM\Column(name="idPersonne", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=30)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Facebook", type="string", length=300, nullable=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=15, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation", type="text", nullable=true)
     */
    private $presentation;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="blob", nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="blob", nullable=true)
     */
    private $avatar;

    /**
     * @var Statut
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\WebsiteBundle\Entity\Statut")
     * @ORM\JoinColumn(name="idStatut", referencedColumnName="idStatut")
     */
    private $statut;

    /**
     * @var Fonction
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\WebsiteBundle\Entity\Fonction")
     * @ORM\JoinColumn(name="idFonction", referencedColumnName="idFonction")
     */
    private $fonction;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Personne
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Personne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return Personne
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Personne
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Personne
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     *
     * @return Personne
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Personne
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return Personne
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set statut
     *
     * @param \RCLAB\WebsiteBundle\Entity\Statut $statut
     *
     * @return Personne
     */
    public function setStatut(\RCLAB\WebsiteBundle\Entity\Statut $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \RCLAB\WebsiteBundle\Entity\Statut
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set fonction
     *
     * @param \RCLAB\WebsiteBundle\Entity\Fonction $fonction
     *
     * @return Personne
     */
    public function setFonction(\RCLAB\WebsiteBundle\Entity\Fonction $fonction = null)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return \RCLAB\WebsiteBundle\Entity\Fonction
     */
    public function getFonction()
    {
        return $this->fonction;
    }
}
