<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * productRating
 *
 * @ORM\Table(name="product_rating")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\productRatingRepository")
 */
class productRating
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
     * @ORM\Column(name="rate", type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 5,
     * )
     */

    private $rate;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $rater;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="rates")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * Set rate.
     *
     * @param int $rate
     *
     * @return productRating
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
     * Set comment.
     *
     * @param string $comment
     *
     * @return productRating
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set product.
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return productRating
     */
    public function setProduct(\AppBundle\Entity\Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set rater.
     *
     * @param \AppBundle\Entity\User|null $rater
     *
     * @return productRating
     */
    public function setRater(\AppBundle\Entity\User $rater = null)
    {
        $this->rater = $rater;

        return $this;
    }

    /**
     * Get rater.
     *
     * @return \AppBundle\Entity\User|null
     */
    public function getRater()
    {
        return $this->rater;
    }
}
