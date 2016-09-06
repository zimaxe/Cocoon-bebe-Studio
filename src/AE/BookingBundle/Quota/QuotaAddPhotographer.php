<?php
/**
 * Par AETZA.
 * Date: 05/09/2016
 * Heure: 14:57
 */

namespace AE\BookingBundle\Quota;


use Doctrine\ORM\EntityManager;

class QuotaAddPhotographer
{
    private $em;
    private $maxSlots;

    /**
     * QuotaHoliday constructor.
     * @param $maxSlots
     * @param EntityManager $manager
     */
    public function __construct($maxSlots, EntityManager $manager)
    {
        $this->maxSlots = $maxSlots;
        $this->em = $manager;
    }

    public function increaseQuota()
    {
        $quotas = $this->em->getRepository('AEBookingBundle:Quota')->getAllSlots();

        foreach($quotas as $quota) {
            $newQuota = $quota->getQuotaNb() + $this->maxSlots;
            $quota->setQuotaNb($newQuota);
            $this->em->persist($quota);
        }
    }



}