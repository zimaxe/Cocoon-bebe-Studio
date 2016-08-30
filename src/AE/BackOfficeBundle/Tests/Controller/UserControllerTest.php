<?php

namespace AE\BackOfficeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/login');
    }

    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/register');
    }

    public function testCustomers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/customers');
    }

    public function testAdmins()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/admins');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/add');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/edit');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/delete');
    }

}
