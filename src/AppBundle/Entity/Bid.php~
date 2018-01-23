<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Bid
 *
 * @ORM\Table(name="bid")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BidRepository")
 */
class Bid
{


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="bids")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $product;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $buyer;

    /**
     * @var float
     *
     * @ORM\Column(name="bidAccount", type="float")
     */
    private $bidAccount;


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
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return Bid
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created.
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated.
     *
     * @param \DateTime $updated
     *
     * @return Bid
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated.
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set product.
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Bid
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
     * Set buyer.
     *
     * @param \AppBundle\Entity\User $buyer
     *
     * @return Bid
     */
    public function setBuyer(\AppBundle\Entity\User $buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * Get buyer.
     *
     * @return \AppBundle\Entity\User
     */
    public function getBuyer()
    {
        return $this->buyer;
    }

    public function __toString()
    {
        return $this->getBidAccount();
    }

    /**
     * Set bidAccount.
     *
     * @param float $bidAccount
     *
     * @return Bid
     */
    public function setBidAccount($bidAccount)
    {
        $this->bidAccount = $bidAccount;

        return $this;
    }

    /**
     * Get bidAccount.
     *
     * @return float
     */
    public function getBidAccount()
    {
        return $this->bidAccount;
    }
}
