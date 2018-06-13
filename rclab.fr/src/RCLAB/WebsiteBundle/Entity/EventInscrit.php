<?php

namespace RCLAB\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventInscrit
 *
 * @ORM\Table(name="event_inscrit")
 * @ORM\Entity(repositoryClass="RCLAB\WebsiteBundle\Repository\EventInscritRepository")
 */
class EventInscrit
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
     * @var bool
     *
     * @ORM\Column(name="isInscrit", type="boolean")
     */
    private $isInscrit;

    /**
     * @ORM\ManyToOne(targetEntity="RCLAB\UserBundle\Entity\User")
     */
    private $inscrit;

    /**
     * @ORM\ManyToOne(targetEntity="RCLAB\WebsiteBundle\Entity\Event")
     */
    private $event;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    public function __construct()
    {
        $this->isInscrit = 0;
        $this->date = new\DateTime('now');
    }

    /**
     * Get idInscrit
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set isInscrit
     *
     * @param boolean $isInscrit
     *
     * @return EventInscrit
     */
    public function setIsInscrit($isInscrit)
    {
        $this->isInscrit = $isInscrit;

        return $this;
    }

    /**
     * Get isInscrit
     *
     * @return bool
     */
    public function getIsInscrit()
    {
        return $this->isInscrit;
    }

    /**
     * Set inscrit
     *
     * @param \RCLAB\UserBundle\Entity\User $inscrit
     *
     * @return EventInscrit
     */
    public function setInscrit(\RCLAB\UserBundle\Entity\User $inscrit = null)
    {
        $this->inscrit = $inscrit;

        return $this;
    }

    /**
     * Get inscrit
     *
     * @return \RCLAB\UserBundle\Entity\User
     */
    public function getInscrit()
    {
        return $this->inscrit;
    }

    /**
     * Set event
     *
     * @param \RCLAB\WebsiteBundle\Entity\Event $event
     *
     * @return EventInscrit
     */
    public function setEvent(Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \RCLAB\WebsiteBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }
}