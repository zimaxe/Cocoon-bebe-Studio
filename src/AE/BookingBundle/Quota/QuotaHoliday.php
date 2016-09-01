<?php
/**
 * Par AETZA.
 * Date: 31/08/2016
 * Heure: 18:00
 */

namespace AE\BookingBundle\Quota;

use AE\BookingBundle\Entity\Quota;
use Doctrine\ORM\EntityManager;

/**
 * Class QuotaHoliday
 * @package AE\BookingBundle\Quota
 */
class QuotaHoliday
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var
     */
    private $maxSlots;

    /**
     * QuotaHoliday constructor.
     * @param $maxSlots
     * @param EntityManager $manager
     */
    public function __construct($maxSlots, EntityManager $manager)
    {
        $this->em = $manager;
        $this->maxSlots = $maxSlots;
    }

    /**
     * @param $startDate
     * @param $endDate
     */
    public function decrementQuota($startDate, $endDate)
    {

        //On recherche le nombre de photographe
        $users = $this->em->getRepository('AEUserBundle:User')->getAdmins();
        //On calcul le quota maximal actuel
        $totalQuota = ($users * $this->maxSlots);

        //On affiche toutes les dates entre startDate et endDate :
        $daysBetween = [];
        foreach (new \DatePeriod($startDate, \DateInterval::createFromDateString('1 day'), $endDate) as $dt) {
            if (!$dt->format('w') == "0") {
                $daysBetween[] = $dt->format('Y-m-d');
            }

        }

        // On ajoute le dernier jour (endDate) au tableau si != de dimanche
        if (!$endDate->format('w') == "0") {
            $daysBetween[] = $endDate->format('Y-m-d');
        }
        //dump($daysBetween); die();

        //On cherche tous les quotas existants entre startDate et endDate
        $quotaExist = $this->em->getRepository('AEBookingBundle:Quota')->getHolidaySlots($startDate, $endDate);
        $quotas = [];
        //On affiche tous les jours de quotas
        foreach ($quotaExist as $q) {
            $quotas[] = $q->getQuotaDay()->format('Y-m-d');
        }

        //Comparaison entre les dates de vacances et les quotas existans en BDD (les dates en commun sont sorties)
        $compareDate = array_diff($daysBetween, $quotas);

        //Boucle sur les dates de vacances
        foreach ($daysBetween as $db) {
            if (!in_array($db, $compareDate)) {
                $newQuota = $quota->getQuotaNb() - $this->maxSlots;
                if ($newQuota < 0) {
                    $newQuota = 0;
                }
                foreach ($quotaExist as $quota) {
                    if ($quota->getQuotaDay() == new \DateTime($db)) {
                        $quota->setQuotaNb($newQuota);
                    }
                }
            } else {
                $quota = new Quota();
                $newQuota = $totalQuota - $this->maxSlots;
                $quota->setQuotaDay(new \DateTime($db));
                $quota->setQuotaNb($newQuota);
            }
            $this->em->persist($quota);
        }

    }

}