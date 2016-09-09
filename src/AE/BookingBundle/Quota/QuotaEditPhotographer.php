<?php
/**
 * Par AETZA.
 * Date: 05/09/2016
 * Heure: 15:13
 */

namespace AE\BookingBundle\Quota;


use AE\BookingBundle\Entity\Quota;
use Doctrine\ORM\EntityManager;

class QuotaEditPhotographer
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

    public function increaseQuota($userId)
    {
        $quotas = $this->compareQuotasHolidays($userId)['quotas'];
        if (!$quotas) {
            return;
        }

        $compareDates = $this->compareQuotasHolidays($userId)['compareDates'];


        foreach ($quotas as $quota) {
            foreach ($compareDates as $compareDate) {
                if ($quota->getQuotaDay() == new \DateTime($compareDate)) {
                    $newQuota = $quota->getQuotaNb() + $this->maxSlots;
                    $quota->setQuotaNb($newQuota);
                    $this->em->persist($quota);
                }
            }
        }
        $this->em->flush();

    }

    public function decreaseQuota($userId)
    {
        $quotas = $this->compareQuotasHolidays($userId)['quotas'];
        if (!$quotas) {
            return;
        }

        $compareDates = $this->compareQuotasHolidays($userId)['compareDates'];


        foreach ($quotas as $quota) {
            foreach ($compareDates as $compareDate) {
                if ($quota->getQuotaDay() == new \DateTime($compareDate)) {
                    $newQuota = $quota->getQuotaNb() - $this->maxSlots;
                    $quota->setQuotaNb($newQuota);
                    $this->em->persist($quota);
                }
            }
        }
        $this->em->flush();
    }


    public function compareQuotasHolidays($userId)
    {
        //Affiche l'ensemble des quotas existants en BDD
        $quotas = $this->em->getRepository('AEBookingBundle:Quota')->getAllSlots();

        if ($quotas) {
            $quotaList = [];
            foreach ($quotas as $q) {
                $quotaList[] = $q->getQuotaDay()->format('Y-m-d');
            }
        } else {
            $quotaList = [];
        }

        //Affiche l'ensemble des vacances du photographe
        $holidays = $this->em->getRepository('AEBookingBundle:Holiday')->getUserHolidays($userId);
        if ($holidays) {
            $daysList = [];
            //On affiche tous les jours de quotas
            foreach ($holidays as $h) {
                foreach (new \DatePeriod($h->getDateStart(), \DateInterval::createFromDateString('1 day'), $h->getDateEnd()) as $dt) {
                    if (!$dt->format('w') == "0") {
                        $daysList[] = $dt->format('Y-m-d');
                    }
                }
                // On ajoute le dernier jour (endDate) au tableau si != de dimanche
                if (!$h->getDateEnd()->format('w') == "0") {
                    $daysList[] = $h->getDateEnd()->format('Y-m-d');
                }
            }
            $compareDates = array_diff($quotaList, $daysList);

        } else {
            $compareDates = $quotaList;
        }

        return array('compareDates' => $compareDates, 'quotas' => $quotas);

    }


}