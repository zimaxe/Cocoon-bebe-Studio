<?php
/**
 * Par AETZA.
 * Date: 08/09/2016
 * Heure: 11:33
 */

namespace AE\BookingBundle\Quota;


use Doctrine\ORM\EntityManager;

class QuotaEditCustomer
{
    private $em;

    /**
     * QuotaEditCustomer constructor.
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->em = $manager;
    }

    /**
     * @param $oldOrderDay
     */
    public function incrementQuotas($oldOrderDay)
    {

        $quota = $this->em->getRepository('AEBookingBundle:Quota')->findOneBy(['quotaDay' => $oldOrderDay]);

        if(!$quota) {
            return;
        }

        if ($quota) {
            $newQuota = $quota->getQuotaNb() + 1;
            $quota->setQuotaNb($newQuota);
            $this->em->persist($quota);
        }


    }

}