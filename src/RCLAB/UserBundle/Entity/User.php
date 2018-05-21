<?php
// src/RCLAB/UserBundle/Entity/User.php

namespace RCLAB\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use RCLAB\WebsiteBundle\Entity\Fonction;
use RCLAB\WebsiteBundle\Entity\Image;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="RCLAB\UserBundle\Repository\User")
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="email", message="Cette adresse mail existe déjà")
 * @UniqueEntity(fields="username", message="Cet utilisateur existe déjà")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\NotBlank(message = "Le nom est obligatoire")
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=30)
     *
     * @Assert\NotBlank(message = "Le prénom est obligatoire")
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="Facebook", type="string", length=300, nullable=true)
     */
    protected $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=15, nullable=true)
     */
    protected $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation", type="text", nullable=true)
     */
    protected $presentation;

    /**
     * @var Image
     *
     * @ORM\Column(name="photo", type="string", nullable=true)
     */
    protected $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", nullable=true)
     */
    protected $avatar;

    /**
     * @var Fonction
     *
     * @ORM\ManyToOne(targetEntity="RCLAB\WebsiteBundle\Entity\Fonction")
     * @ORM\JoinColumn(name="idFonction", referencedColumnName="idFonction")
     */
    protected $fonction;
//
//    /**
//     * @Assert\NotBlank(message="L'adresse mail est obligatoire")
//     * @Assert\Email(
//     *     message="L'adresse mail '{{ value }}' n'est pas valide",
//     *     checkMX=true
//     * )
//     */
//    protected $email;
//
//    /**
//     * @Assert\NotBlank(message="Le nom d'utilisateur est obligatoire")
//     */
//    protected $username;
//
//    /**
//     * @Assert\NotBlank(message="Mot de passe obligatoire")
//     */
//    protected $plainpassword;

    public function __toString()
    {
        return $this->firstName .' '. $this->lastName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return User
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
     * @return User
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
     * Set presentation
     *
     * @param string $presentation
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * Set fonction
     *
     * @param Fonction $fonction
     *
     * @return User
     */
    public function setFonction(Fonction $fonction = null)
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
