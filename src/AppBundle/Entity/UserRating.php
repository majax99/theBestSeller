<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * UserRating
 *
 * @ORM\Table(name="user_rating")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRatingRepository")
 */
class UserRating
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="userRates")
     * @ORM\JoinColumn(onDelete="CASCADE", nullable=false)
     */
    private $userRate;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rater;

    /**
     * @ORM\Column(name = "product_id",type="integer", unique=true)
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Product", cascade={"persist"})
     */
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(name="rate", type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 5,
     * )
     */
    private $rate;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rate.
     *
     * @param int $rate
     *
     * @return UserRating
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate.
     *
     * @return int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set userRate.
     *
     * @param \AppBundle\Entity\User $userRate
     *
     * @return UserRating
     */
    public function setUserRate(\AppBundle\Entity\User $userRate)
    {
        $this->userRate = $userRate;

        return $this;
    }

    /**
     * Get userRate.
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserRate()
    {
        return $this->userRate;
    }

    /**
     * Set rater.
     *
     * @param \AppBundle\Entity\User $rater
     *
     * @return UserRating
     */
    public function setRater(\AppBundle\Entity\User $rater)
    {
        $this->rater = $rater;

        return $this;
    }

    /**
     * Get rater.
     *
     * @return \AppBundle\Entity\User
     */
    public function getRater()
    {
        return $this->rater;
    }

    /**
     * Set product.
     *
     * @param int $product
     *
     * @return UserRating
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return int
     */
    public function getProduct()
    {
        return $this->product;
    }
}
