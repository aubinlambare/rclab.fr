<?php

namespace RCLAB\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="idDemande", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Objet", type="string", length=100)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text")
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
     * @ORM\Column(name="Fin", type="datetime", nullable=true)
     */
    private $fin;

    /**
     * @var bool
     *
     * @ORM\Column(name="GroupeEvent", type="boolean")
     */
    private $groupeEvent;


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
     * @var Personne
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\WebsiteBundle\Entity\Personne")
     * @ORM\JoinColumn(name="faire", referencedColumnName="idPersonne")
     *
     */
    private $faireDemande;

    /**
     * @var Personne
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\WebsiteBundle\Entity\Personne")
     * @ORM\JoinColumn(name="demander", referencedColumnName="idPersonne")
     */
    private $demander;

    /**
     * @var Personne
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\WebsiteBundle\Entity\Personne")
     * @ORM\JoinColumn(name="autoriser", referencedColumnName="idPersonne")
     */
    private $autoriser;

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
     * @return bool
     */
    public function getGroupeEvent()
    {
        return $this->groupeEvent;
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
     * Set faireDemande
     *
     * @param \RCLAB\WebsiteBundle\Entity\Personne $faireDemande
     *
     * @return Demande
     */
    public function setFaireDemande(Personne $faireDemande = null)
    {
        $this->faireDemande = $faireDemande;

        return $this;
    }

    /**
     * Get faireDemande
     *
     * @return \RCLAB\WebsiteBundle\Entity\Personne
     */
    public function getFaireDemande()
    {
        return $this->faireDemande;
    }

    /**
     * Set demander
     *
     * @param \RCLAB\WebsiteBundle\Entity\Personne $demander
     *
     * @return Demande
     */
    public function setDemander(Personne $demander = null)
    {
        $this->demander = $demander;

        return $this;
    }

    /**
     * Get demander
     *
     * @return \RCLAB\WebsiteBundle\Entity\Personne
     */
    public function getDemander()
    {
        return $this->demander;
    }

    /**
     * Set autoriser
     *
     * @param \RCLAB\WebsiteBundle\Entity\Personne $autoriser
     *
     * @return Demande
     */
    public function setAutoriser(Personne $autoriser = null)
    {
        $this->autoriser = $autoriser;

        return $this;
    }

    /**
     * Get autoriser
     *
     * @return \RCLAB\WebsiteBundle\Entity\Personne
     */
    public function getAutoriser()
    {
        return $this->autoriser;
    }
}
