<?php
/**
 * Par AETZA.
 * Date: 05/09/2016
 * Heure: 16:43
 */

namespace AE\BookingBundle\DoctrineListener;



use AE\UserBundle\Entity\User;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class UserIsNotActiveListener
{

    private $container;
    private $requestStack;

    public function __construct(ContainerInterface $container, RequestStack $requestStack)
    {
        $this->container = $container;
        $this->requestStack = $requestStack;
    }

    public function postUpdate(LifecycleEventArgs $eventArgs) {

        $entity = $eventArgs->getObject();

        if(!$entity instanceof User){
            return;
        }

        $oldIsActive = $this->requestStack->getCurrentRequest()->attributes->get('oldIsActive');
        $newIsActive = $entity->getIsActive();

        if($oldIsActive !== $newIsActive){
            $editPhotographer = $this->container->get('ae_booking.quota.quota_edit_photographer');
            if($newIsActive == false ){
                $editPhotographer->decreaseQuota($entity->getId());
            }else {
                $editPhotographer->increaseQuota($entity->getId());
            }
        }



    }

}