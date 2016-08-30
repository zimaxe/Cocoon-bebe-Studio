<?php
/**
 * Par AETZA.
 * Date: 30/08/2016
 * Heure: 14:34
 */

namespace AE\BookingBundle\DataFixtures\ORM;


use AE\BookingBundle\Entity\Customer;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadCustomer implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $customer = [
             [
                'order_date' => new \DateTime('2016-09-10'),
                'name' => 'Gramond-Zamoun',
                'firstName' => 'Bénédicte',
                'babyName' => 'Zamoun',
                'babyFirstName' => 'Joachim',
                'dateBirth' => new \dateTime('2016-05-03'),
                'gender' => 0,
                'weight' => 2.600,
                'height' => '46',
                'address' => '2 rue du Perron',
                'zip' => '69600',
                'city' => 'Oullins',
                'phone' => '',
                'mobileMother' => '0650632408',
                'mobileFather' => '0689200371',
                'emailMother' => 'benedicte.gramond@gmail.com',
                'emailFather' => 'zimaxe@hotmail.fr',
                'maternity_id' => 1
            ],
            [
                'order_date' => new \DateTime('2016-09-10'),
                'name' => 'Tarazona',
                'firstName' => 'Céline',
                'babyName' => 'Tarazona',
                'babyFirstName' => 'Miassa',
                'dateBirth' => new \DateTime('2016-09-14'),
                'gender' => 1,
                'weight' => 2.8500,
                'height' => '52',
                'address' => '2 rue de Bigeau',
                'zip' => '33480',
                'city' => 'Parempuyre',
                'phone' => '',
                'mobileMother' => '0650632408',
                'mobileFather' => '0689200371',
                'emailMother' => 'contact@globalshoot.net',
                'emailFather' => '',
                'maternity_id' => 2
            ],

        ];


        foreach ($customer as $customers) {
            $client = new Customer();

            $client->setOrderDate($customers['order_date']);
            $client->setName($customers['name']);
            $client->setFirstName($customers['firstName']);
            $client->setBabyName($customers['babyName']);
            $client->setBabyFirstName($customers['babyFirstName']);
            $client->setDateBirth($customers['dateBirth']);
            $client->setGender($customers['gender']);
            $client->setWeight($customers['weight']);
            $client->setHeight($customers['height']);
            $client->setAddress($customers['address']);
            $client->setZip($customers['zip']);
            $client->setCity($customers['city']);
            $client->setPhone($customers['phone']);
            $client->setMobileMother($customers['mobileMother']);
            $client->setMobileFather($customers['mobileFather']);
            $client->setEmailMother($customers['emailMother']);
            $client->setEmailFather($customers['emailFather']);
            $client->setMaternityId($customers['maternity_id']);





            $manager->persist($client);
        }

        $manager->flush();
    }
}