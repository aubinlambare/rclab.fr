<?php

namespace RCLAB\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 */
class Actualite
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     *
     * @Assert\NotBlank(message = "Le titre est obligatoire")
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     *
     * @Assert\NotBlank(message = "La description est obligatoire")
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=1000, nullable=true)
     *
     * @Assert\Url(message="L'adresse '{{ value }}' n'est pas valide")
     */
    protected $link;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", nullable=true)
     *
     */
    protected $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut_publication", type="datetime")
     */
    protected $share_date;

    /**
     * @var bool
     *
     * @ORM\Column(name="focus", type="boolean")
     */
    protected $focus;

    /**
     * @var int
     *
     * @ORM\Column(name="PrioriteFocus", type="smallint", nullable=true)
     *
     * @Assert\GreaterThan(
     *     value = 0,
     *     message = "La valeur doit être comprise entre 1 et 10"
     * )
     *
     * @Assert\LessThanOrEqual(
     *     value = 10,
     *     message = "La valeur doit être comprise entre 1 et 10"
     * )
     */
    protected $priorite_focus;

    /**
     * @var Personne
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\WebsiteBundle\Entity\Personne")
     * @ORM\JoinColumn(name="shared_by", referencedColumnName="idPersonne")
     */
    protected $sharedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="datetime")
     */
    protected $date_start;
}