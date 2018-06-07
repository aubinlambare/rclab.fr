<?php
namespace RCLAB\WebsiteBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Event
 *
 * @ORM\Table(name="Event")
 * @ORM\Entity(repositoryClass="RCLAB\WebsiteBundle\Repository\EventRepository")
 */
class Event extends Actualite
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
     * @var int
     *
     * @ORM\Column(name="MaxParticipants", type="smallint", nullable=true)
     *
     * @Assert\GreaterThan(
     *     value = 0,
     *     message = "Il faut au moins un participant"
     * )
     *
     * @Assert\LessThanOrEqual(
     *     value = 32767,
     *     message = "Il y a trop de monde de prévu"
     * )
     */
    private $maxParticipants;
    /**
     * @var int
     *
     * @ORM\Column(name="NbInscrits", type="smallint", nullable=true)
     *
     * @Assert\GreaterThanOrEqual(
     *     value = 0,
     *     message = "Nombre d'isncrit négatif impossible"
     * )
     *
     * @Assert\LessThanOrEqual(
     *     value = 32767,
     *     message = "Il y a trop de monde d'inscrit"
     * )
     *
     */
    private $nbInscrits;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="datetime")
     *
     */
    private $date_end;
    public function __construct()
    {
        $this->share_date = new \DateTime('NOW');
        $this->date_start = new \DateTime('NOW');
        $this->date_end = new \DateTime('NOW');
    }
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
     * Set maxParticipants
     *
     * @param integer $maxParticipants
     *
     * @return Event
     */
    public function setMaxParticipants($maxParticipants)
    {
        $this->maxParticipants = $maxParticipants;
        return $this;
    }
    /**
     * Get maxParticipants
     *
     * @return integer
     */
    public function getMaxParticipants()
    {
        return $this->maxParticipants;
    }
    /**
     * Set nbInscrits
     *
     * @param integer $nbInscrits
     *
     * @return Event
     */
    public function setNbInscrits($nbInscrits)
    {
        $this->nbInscrits = $nbInscrits;
        return $this;
    }
    /**
     * Get nbInscrits
     *
     * @return integer
     */
    public function getNbInscrits()
    {
        return $this->nbInscrits;
    }
    /**
     * Set title
     *
     * @param string $title
     *
     * @return Event
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Set description
     *
     * @param string $description
     *
     * @return Event
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
     * Set link
     *
     * @param string $link
     *
     * @return Event
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }
    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
    /**
     * Set image
     *
     * @param string $image
     *
     * @return Event
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }
    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Set shareDate
     *
     * @param \DateTime $shareDate
     *
     * @return Event
     */
    public function setShareDate($shareDate)
    {
        $this->share_date = $shareDate;
        return $this;
    }
    /**
     * Get shareDate
     *
     * @return \DateTime
     */
    public function getShareDate()
    {
        return $this->share_date;
    }
    /**
     * Set focus
     *
     * @param boolean $focus
     *
     * @return Event
     */
    public function setFocus($focus)
    {
        $this->focus = $focus;
        return $this;
    }
    /**
     * Get focus
     *
     * @return boolean
     */
    public function getFocus()
    {
        return $this->focus;
    }
    /**
     * Set prioriteFocus
     *
     * @param integer $prioriteFocus
     *
     * @return Event
     */
    public function setPrioriteFocus($prioriteFocus)
    {
        $this->priorite_focus = $prioriteFocus;
        return $this;
    }
    /**
     * Get prioriteFocus
     *
     * @return integer
     */
    public function getPrioriteFocus()
    {
        return $this->priorite_focus;
    }
    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Event
     */
    public function setDateEnd($dateEnd)
    {
        $this->date_end = $dateEnd;
        return $this;
    }
    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->date_end;
    }
    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Event
     */
    public function setDateStart($dateStart)
    {
        $this->date_start = $dateStart;
        return $this;
    }
    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->date_start;
    }
    /**
     * Set sharedBy
     *
     * @param \RCLAB\WebsiteBundle\Entity\Personne $sharedBy
     *
     * @return Event
     */
    public function setSharedBy(Personne $sharedBy = null)
    {
        $this->sharedBy = $sharedBy;
        return $this;
    }
    /**
     * Get sharedBy
     *
     * @return \RCLAB\WebsiteBundle\Entity\Personne
     */
    public function getSharedBy()
    {
        return $this->sharedBy;
    }
}

