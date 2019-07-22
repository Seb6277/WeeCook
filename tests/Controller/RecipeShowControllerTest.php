<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RecipeShowControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testShowPageIsUp()
    {
        $this->client->request('GET', '/show');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testShowPageIsRenderingCorrectly()
    {
        $this->client->request('GET', '/show');

        static::assertContains('h1', $this->client->getResponse()->getContent());
    }
}