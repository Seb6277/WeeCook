<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ProfilControllerTest extends WebTestCase
{
    private $client;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testProfilPageIsUp(){
        $this->client->request('GET', '/profil');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testProfilPageIsRenderingCorrectly(){
        $this->client->request('GET', '/profil');

        static::assertContains('h1', $this->client->getResponse()->getContent());
    }
}