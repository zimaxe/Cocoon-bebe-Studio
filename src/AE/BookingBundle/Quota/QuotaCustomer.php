<?php
/**
 * Par AETZA.
 * Date: 31/08/2016
 * Heure: 13:22
 */

namespace AE\BookingBundle\Quota;


use AE\BookingBundle\Entity\Quota;
use Doctrine\ORM\EntityManager;

/**
 * Class QuotaCustomer
 * @package AE\BookingBundle\Quota
 */
class QuotaCustomer
{
    private $em;
    private $maxSlots;

    /**
     * QuotaCustomer constructor.
     * @param $maxSlots
     * @param EntityManager $manager
     */
    public function __construct($maxSlots, EntityManager $manager)
    {
        $this->em = $manager;
        $this->maxSlots = $maxSlots;
    }

    /**
     * @param $orderDay
     */
    public function decrementQuotas($orderDay)
    {

        $quota = $this->em->getRepository('AEBookingBundle:Quota')->findOneBy(['quotaDay' => $orderDay]);
        $photographers= $this->em->getRepository('AEUserBundle:User')->getPhotographersCount();
        $totalQuota = ($photographers * $this->maxSlots);

        if ($quota) {
            $newQuota = $quota->getQuotaNb() - 1;
            $quota->setQuotaNb($newQuota);
        } else {
            $quota = new Quota();
            $quota->setQuotaDay($orderDay);
            $quotaNb = $totalQuota - 1;
            $quota->setQuotaNb($quotaNb);
        }

        $this->em->persist($quota);

    }

}