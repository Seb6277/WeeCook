<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HomeControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testHomepageIsUp() {
        $this->client->request('GET', '/');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testNavbarIsRenderingCorrectly() {
        $this->client->request('GET', '/');

        $this->assertContains('nav', $this->client->getResponse()->getContent());
    }

    public function testSigninPageIsUp() {
        $this->client->request('GET', '/signin');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testSigninPageIsRenderingCorrectly() {
        $this->client->request('GET', '/signin');

        $this->assertContains('h2', $this->client->getResponse()->getContent());
    }

    public function testSignupPageIsUp() {
        $this->client->request('GET', '/signup');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testSignupPageIsRenderingCorrectly() {
        $this->client->request('GET', '/signup');

        $this->assertContains('h2', $this->client->getResponse()->getContent());
    }
}