<?php

namespace AE\BookingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quota
 *
 * @ORM\Table(name="quota")
 * @ORM\Entity(repositoryClass="AE\BookingBundle\Repository\QuotaRepository")
 */
class Quota
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
     * @var \DateTime
     *
     * @ORM\Column(name="quotaDay", type="date", unique=true)
     */
    private $quotaDay;

    /**
     * @var int
     *
     * @ORM\Column(name="quota", type="integer")
     */
    private $quotaNb;


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
     * Set quotaDay
     *
     * @param \DateTime $quotaDay
     *
     * @return Quota
     */
    public function setQuotaDay($quotaDay)
    {
        $this->quotaDay = $quotaDay;

        return $this;
    }

    /**
     * Get quotaDay
     *
     * @return \DateTime
     */
    public function getQuotaDay()
    {
        return $this->quotaDay;
    }

    /**
     * Set quotaNb
     *
     * @param integer $quotaNb
     *
     * @return Quota
     */
    public function setQuotaNb($quotaNb)
    {
        $this->quotaNb = $quotaNb;

        return $this;
    }

    /**
     * Get quotaNb
     *
     * @return integer
     */
    public function getQuotaNb()
    {
        return $this->quotaNb;
    }
}
