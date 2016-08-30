<?php
/**
 * Par AETZA.
 * Date: 22/08/2016
 * Heure: 18:51
 */

namespace AE\UserBundle\DataFixtures\ORM;


use AE\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUser /**implements FixtureInterface, ContainerAwareInterface**/
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $names = [
            'contact@aetza.com' => 'ROLE_ADMIN',
            'zimaxe@hotmail.fr' => 'ROLE_USER',
            'contact.aetza@gmail.com' => 'ROLE_USER'
        ];


        foreach($names as $key => $role) {
            $user = new User;
            //$password = $this->get('security.password_encoder')->encodePassword($user, '02dec78');
            $password =  $this->container->get('security.password_encoder')->encodePassword($user, '02dec78');
            $user->setEmail($key);
            $user->setPassword( $password );

            $user->setRoles([$role]);

            $manager->persist($user);
        }

        $manager->flush();
    }

}