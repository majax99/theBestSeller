<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrdersRepository")
 */
class Orders
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $buyer;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $seller;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Product", inversedBy="orders")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Category", cascade={"persist"})
     */
    private $category;

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
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


    /**
     * @var bool
     *
     * @ORM\Column(name="immediateSell", type="boolean")
     */
    private $immediateSell;


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
     * Set price.
     *
     * @param float $price
     *
     * @return Orders
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set immediateSell.
     *
     * @param bool $immediateSell
     *
     * @return Orders
     */
    public function setImmediateSell($immediateSell)
    {
        $this->immediateSell = $immediateSell;

        return $this;
    }

    /**
     * Get immediateSell.
     *
     * @return bool
     */
    public function getImmediateSell()
    {
        return $this->immediateSell;
    }

    /**
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return Orders
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
     * @return Orders
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
     * Set buyer.
     *
     * @param \AppBundle\Entity\User $buyer
     *
     * @return Orders
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

    /**
     * Set seller.
     *
     * @param \AppBundle\Entity\User $seller
     *
     * @return Orders
     */
    public function setSeller(\AppBundle\Entity\User $seller)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get seller.
     *
     * @return \AppBundle\Entity\User
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * Set product.
     *
     * @param \AppBundle\Entity\Product|null $product
     *
     * @return Orders
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return \AppBundle\Entity\Product|null
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set category.
     *
     * @param \AppBundle\Entity\Category|null $category
     *
     * @return Orders
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \AppBundle\Entity\Category|null
     */
    public function getCategory()
    {
        return $this->category;
    }
}
