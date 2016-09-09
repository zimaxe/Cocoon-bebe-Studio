<?php

namespace AE\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Maternity
 *
 * @ORM\Table(name="maternity")
 * @ORM\Entity(repositoryClass="AE\BookingBundle\Repository\MaternityRepository")
 */
class Maternity
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true, nullable=false)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="isActive", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="AE\BookingBundle\Entity\Customer", mappedBy="maternity")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->customer = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isActive = true;
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
     * Set name
     *
     * @param string $name
     *
     * @return Maternity
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Maternity
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Get customer
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Add customer
     *
     * @param \AE\BookingBundle\Entity\Customer $customer
     *
     * @return Maternity
     */
    public function addCustomer(\AE\BookingBundle\Entity\Customer $customer)
    {
        $this->customer[] = $customer;

        return $this;
    }

    /**
     * Remove customer
     *
     * @param \AE\BookingBundle\Entity\Customer $customer
     */
    public function removeCustomer(\AE\BookingBundle\Entity\Customer $customer)
    {
        $this->customer->removeElement($customer);
    }
}
