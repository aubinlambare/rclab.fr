<?php

namespace RCLAB\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use RCLAB\UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Demande
 *
 * @ORM\Table(name="Demande")
 * @ORM\Entity(repositoryClass="RCLAB\WebsiteBundle\Repository\DemandeRepository")
 */
class Demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Objet", type="string", length=100)
     *
     * @Assert\NotBlank(message="L'objet est obligatoire")
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text")
     *
     * @Assert\NotBlank(message="La description est obligatoire")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="DisponibiliteDemandeur", type="text", nullable=true)
     */
    private $disponibiliteDemandeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Debut", type="datetime", nullable=true)
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_demande", type="datetime")
     */
    private $dateDemande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="duree", type="time", nullable=true)
     */
    private $duree;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Fin", type="datetime", nullable=true)
     */
    private $fin;

    /**
     * @var bool
     *
     * @ORM\Column(name="GroupeEvent", type="boolean", nullable=true)
     */
    private $groupeEvent;

    /**
     * @var bool
     *
     * @ORM\Column(name="autorise", type="boolean", nullable=true)
     */
    private $autorise;


    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var T_Demande
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\WebsiteBundle\Entity\T_Demande")
     * @ORM\JoinColumn(name="idTDemande", referencedColumnName="idTDemande")
     */
    private $tdemande;

    /**
     * @var Matiere
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\WebsiteBundle\Entity\Matiere")
     * @ORM\JoinColumn(name="idMatiere", referencedColumnName="idMatiere")
     */
    private $matiere;

    /**
     * @var Niveau
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\WebsiteBundle\Entity\Niveau")
     * @ORM\JoinColumn(name="idNiveau", referencedColumnName="idNiveau")
     */
    private $niveau;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idDemandeur", referencedColumnName="id")
     *
     */
    private $demandeur;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idResponsable", referencedColumnName="id")
     */
    private $responsable;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idProfesseur", referencedColumnName="id")
     */
    private $professeur;


    /**
     * @ORM\ManyToMany(targetEntity="RCLAB\UserBundle\Entity\User")
     */
    private $inscrits;

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
     * Set objet
     *
     * @param string $objet
     *
     * @return Demande
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Demande
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
     * Set disponibiliteDemandeur
     *
     * @param string $disponibiliteDemandeur
     *
     * @return Demande
     */
    public function setDisponibiliteDemandeur($disponibiliteDemandeur)
    {
        $this->disponibiliteDemandeur = $disponibiliteDemandeur;

        return $this;
    }

    /**
     * Get disponibiliteDemandeur
     *
     * @return string
     */
    public function getDisponibiliteDemandeur()
    {
        return $this->disponibiliteDemandeur;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return Demande
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return Demande
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set groupeEvent
     *
     * @param boolean $groupeEvent
     *
     * @return Demande
     */
    public function setGroupeEvent($groupeEvent)
    {
        $this->groupeEvent = $groupeEvent;

        return $this;
    }

    /**
     * Get groupeEvent
     *
     * @return boolean
     */
    public function getGroupeEvent()
    {
        return $this->groupeEvent;
    }

    /**
     * Set autorise
     *
     * @param boolean $autorise
     *
     * @return Demande
     */
    public function setAutorise($autorise)
    {
        $this->autorise = $autorise;

        return $this;
    }

    /**
     * Get autorise
     *
     * @return boolean
     */
    public function getAutorise()
    {
        return $this->autorise;
    }

    /**
     * Set tdemande
     *
     * @param \RCLAB\WebsiteBundle\Entity\T_Demande $tdemande
     *
     * @return Demande
     */
    public function setTdemande(T_Demande $tdemande = null)
    {
        $this->tdemande = $tdemande;

        return $this;
    }

    /**
     * Get tdemande
     *
     * @return \RCLAB\WebsiteBundle\Entity\T_Demande
     */
    public function getTdemande()
    {
        return $this->tdemande;
    }

    /**
     * Set matiere
     *
     * @param \RCLAB\WebsiteBundle\Entity\Matiere $matiere
     *
     * @return Demande
     */
    public function setMatiere(Matiere $matiere = null)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get matiere
     *
     * @return \RCLAB\WebsiteBundle\Entity\Matiere
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * Set niveau
     *
     * @param \RCLAB\WebsiteBundle\Entity\Niveau $niveau
     *
     * @return Demande
     */
    public function setNiveau(Niveau $niveau = null)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return \RCLAB\WebsiteBundle\Entity\Niveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }


    /**
     * Set demandeur
     *
     * @param \RCLAB\UserBundle\Entity\User $demandeur
     *
     * @return Demande
     */
    public function setDemandeur(User $demandeur = null)
    {
        $this->demandeur = $demandeur;

        return $this;
    }

    /**
     * Get demandeur
     *
     * @return \RCLAB\UserBundle\Entity\User
     */
    public function getDemandeur()
    {
        return $this->demandeur;
    }

    /**
     * Set responsable
     *
     * @param \RCLAB\UserBundle\Entity\User $responsable
     *
     * @return Demande
     */
    public function setResponsable(User $responsable = null)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return \RCLAB\UserBundle\Entity\User
     */
    public function getResponsable()
    {
        return $this->responsable;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inscrits = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateDemande = new \DateTime('NOW');
    }

    /**
     * Set professeur
     *
     * @param \RCLAB\UserBundle\Entity\User $professeur
     *
     * @return Demande
     */
    public function setProfesseur(User $professeur = null)
    {
        $this->professeur = $professeur;

        return $this;
    }

    /**
     * Get professeur
     *
     * @return \RCLAB\UserBundle\Entity\User
     */
    public function getProfesseur()
    {
        return $this->professeur;
    }

    /**
     * Add inscrit
     *
     * @param \RCLAB\UserBundle\Entity\User $inscrit
     *
     * @return Demande
     */
    public function addInscrit(User $inscrit)
    {
        $this->inscrits[] = $inscrit;

        return $this;
    }

    /**
     * Remove inscrit
     *
     * @param \RCLAB\UserBundle\Entity\User $inscrit
     */
    public function removeInscrit(User $inscrit)
    {
        $this->inscrits->removeElement($inscrit);
    }

    /**
     * Get inscrits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInscrits()
    {
        return $this->inscrits;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Demande
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set dateDemande
     *
     * @param \DateTime $dateDemande
     *
     * @return Demande
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    /**
     * Get dateDemande
     *
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * Set duree
     *
     * @param \DateTime $duree
     *
     * @return Demande
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return \DateTime
     */
    public function getDuree()
    {
        return $this->duree;
    }
}
