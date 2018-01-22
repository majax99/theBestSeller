<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends \FOS\UserBundle\Model\User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    protected $firstname;



    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    protected $lastname;


    /**
     * @var string
     *
     * @ORM\Column(name="postalAdress", type="string", length=255)
     */
    protected $postalAdress;


    /**
     * @var string
     *
     * @ORM\Column(name="zipCode", type="string", length=50)
     */
    protected $zipCode;


    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    protected $city;

    /**
     * @var int
     *
     * @ORM\Column(name="userVisits", type="integer", nullable=true)
     */
    private $userVisits;


    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;


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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return User
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return User
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set firstname.
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname.
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }


    /**
     * Set postalAdress.
     *
     * @param string $postalAdress
     *
     * @return User
     */
    public function setPostalAdress($postalAdress)
    {
        $this->postalAdress = $postalAdress;

        return $this;
    }

    /**
     * Get postalAdress.
     *
     * @return string
     */
    public function getPostalAdress()
    {
        return $this->postalAdress;
    }

    /**
     * Set zipCode.
     *
     * @param string $zipCode
     *
     * @return User
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode.
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set city.
     *
     * @param string $city
     *
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set userVisits.
     *
     * @param int $userVisits
     *
     * @return User
     */
    public function setUserVisits($userVisits)
    {
        $this->userVisits = $userVisits;

        return $this;
    }

    /**
     * Get userVisits.
     *
     * @return int
     */
    public function getUserVisits()
    {
        return $this->userVisits;
    }
}
