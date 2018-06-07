<?php
namespace RCLAB\WebsiteBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * News
 *
 * @ORM\Table(name="News")
 * @ORM\Entity(repositoryClass="RCLAB\WebsiteBundle\Repository\NewsRepository")
 */
class News extends Actualite
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    public function __construct()
    {
        $this->share_date = new \DateTime('NOW');
        $this->date_start = $this->share_date;
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
     * Set title
     *
     * @param string $title
     *
     * @return News
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
     * @return News
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
     * @return News
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
     * @return News
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
     * @return News
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
     * @return News
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
     * @return News
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
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return News
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
     * @return News
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