<?php
/**
 * Par AETZA.
 * Date: 02/09/2016
 * Heure: 15:27
 */

namespace AE\BookingBundle\Quota;


use Doctrine\ORM\EntityManager;

class QuotaHolidayDelete
{
    private $em;
    private $maxSlots;

    public function __construct($maxSlots, EntityManager $manager)
    {
        $this->maxSlots = $maxSlots;
        $this->em = $manager;
    }

    public function increaseSlots($startDate, $endDate){


        $quotas = $this->em->getRepository('AEBookingBundle:Quota')->getHolidaySlots($startDate, $endDate);

        foreach($quotas as $quota){
            $newQuota = $quota->getQuotaNb() + $this->maxSlots;
            $quota->setQuotaNb($newQuota);
        }
        $this->em->persist($quota);

    }


}