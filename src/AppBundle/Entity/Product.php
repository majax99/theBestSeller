<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
{

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="product", cascade={"persist", "remove"})
     */
    protected $images;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\productRating", mappedBy="product")
     */
    protected $rates;



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Bid", mappedBy="product")
     */
    private $bids;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;



    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Orders", mappedBy="product", cascade={"persist"})
     */
    private $orders;



    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="biddingStart", type="datetime", nullable=true)
     */
    private $biddingStart;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="biddingEnd", type="datetime")
     */
    private $biddingEnd;


    /**
     * @var float
     *
     * @ORM\Column(name="bidMinimum", type="float")
     */
    private $bidMinimum;

    /**
     * @var float
     *
     * @ORM\Column(name="minimumPrice", type="float")
     */
    private $minimumPrice;


    /**
     * @var float
     *
     * @ORM\Column(name="immediatePrice", type="float",nullable=true)
     */
    private $immediatePrice;


    /**
     * @var int
     *
     * @ORM\Column(name="productVisits", type="integer", nullable=true)
     */
    private $productVisits = 0;


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

    public function __construct()
    {
        $this->biddingStart = new \DateTime();
        $this->images = new ArrayCollection();
        $this->bids = new ArrayCollection();
    }

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
     * Set title
     *
     * @param string $title
     *
     * @return Product
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
     * @return Product
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
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Product
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
     * @return Product
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

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Set biddingStart.
     *
     * @param \DateTime $biddingStart
     *
     * @return Product
     */
    public function setBiddingStart($biddingStart)
    {
        $this->biddingStart = $biddingStart;

        return $this;
    }

    /**
     * Get biddingStart.
     *
     * @return \DateTime
     */
    public function getBiddingStart()
    {
        return $this->biddingStart;
    }

    /**
     * Set biddingEnd.
     *
     * @param \DateTime $biddingEnd
     *
     * @return Product
     */
    public function setBiddingEnd($biddingEnd)
    {
        $this->biddingEnd = $biddingEnd;

        return $this;
    }

    /**
     * Get biddingEnd.
     *
     * @return \DateTime
     */
    public function getBiddingEnd()
    {
        return $this->biddingEnd;
    }

    /**
     * Set bidMinimum.
     *
     * @param float $bidMinimum
     *
     * @return Product
     */
    public function setBidMinimum($bidMinimum)
    {
        $this->bidMinimum = $bidMinimum;

        return $this;
    }

    /**
     * Get bidMinimum.
     *
     * @return float
     */
    public function getBidMinimum()
    {
        return $this->bidMinimum;
    }

    /**
     * Set productVisits.
     *
     * @param int $productVisits
     *
     * @return Product
     */
    public function setProductVisits($productVisits)
    {
        $this->productVisits = $productVisits;

        return $this;
    }

    /**
     * Get productVisits.
     *
     * @return int
     */
    public function getProductVisits()
    {
        return $this->productVisits;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Product
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set minimumPrice.
     *
     * @param float $minimumPrice
     *
     * @return Product
     */
    public function setMinimumPrice($minimumPrice)
    {
        $this->minimumPrice = $minimumPrice;

        return $this;
    }

    /**
     * Get minimumPrice.
     *
     * @return float
     */
    public function getMinimumPrice()
    {
        return $this->minimumPrice;
    }

    /**
     * Set immediatePrice.
     *
     * @param float $immediatePrice
     *
     * @return Product
     */
    public function setImmediatePrice($immediatePrice)
    {
        $this->immediatePrice = $immediatePrice;

        return $this;
    }

    /**
     * Get immediatePrice.
     *
     * @return float
     */
    public function getImmediatePrice()
    {
        return $this->immediatePrice;
    }

    /**
     * Add image.
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Product
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $image->setProduct($this);
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image.
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        return $this->images->removeElement($image);
    }

    /**
     * Get images.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add bid.
     *
     * @param \AppBundle\Entity\Bid $bid
     *
     * @return Product
     */
    public function addBid(\AppBundle\Entity\Bid $bid)
    {
        $this->bids[] = $bid;

        return $this;
    }

    /**
     * Remove bid.
     *
     * @param \AppBundle\Entity\Bid $bid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBid(\AppBundle\Entity\Bid $bid)
    {
        return $this->bids->removeElement($bid);
    }

    /**
     * Get bids.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBids()
    {
        return $this->bids;
    }

    /**
     * Add rate.
     *
     * @param \AppBundle\Entity\productRating $rate
     *
     * @return product
     */
    public function addRate(\AppBundle\Entity\productRating $rate)
    {
        $this->rates[] = $rate;

        return $this;
    }

    /**
     * Remove rate.
     *
     * @param \AppBundle\Entity\productRating $rate
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRate(\AppBundle\Entity\productRating $rate)
    {
        return $this->rates->removeElement($rate);
    }

    /**
     * Get rates.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRates()
    {
        return $this->rates;
    }

    /**
     * Set orders.
     *
     * @param \AppBundle\Entity\Orders|null $orders
     *
     * @return product
     */
    public function setOrders(\AppBundle\Entity\Orders $orders = null)
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * Get orders.
     *
     * @return \AppBundle\Entity\Orders|null
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
