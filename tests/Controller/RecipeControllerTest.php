<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RecipeControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testShowPageIsUp() {
        $this->client->request('GET', '/show');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testShowPageIsRenderingCorrectly() {
        $this->client->request('GET', '/show');

        static::assertContains('h1', $this->client->getResponse()->getContent());
    }

    public function testModeratePageIsUp() {
        $this->client->request('GET', '/moderate');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testModeratePageIsRenderCorrectly() {
        $this->client->request('GET', '/moderate');

        static::assertContains('h1', $this->client->getResponse()->getContent());
    }

    public function testCreatePageIsUp() {
        $this->client->request('GET', '/create');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()-> getStatusCode());
    }

    public function testCreatePageIsRenderCorrectly() {
        $this->client->request('GET', '/create');

        static::assertContains('h1', $this->client->getResponse()->getContent());
    }
}