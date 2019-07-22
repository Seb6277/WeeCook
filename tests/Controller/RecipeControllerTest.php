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

    public function testCreatePageIsUp() {
        $this->client->request('GET', '/create');

        static::assertEquals(Response::HTTP_FOUND, $this->client->getResponse()-> getStatusCode());
    }

    public function testCreatePageIsRenderCorrectly() {
        $this->client->request('GET', '/create');

        static::assertContains('Redirecting', $this->client->getResponse()->getContent());
    }
}