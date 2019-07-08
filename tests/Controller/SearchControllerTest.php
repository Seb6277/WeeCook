<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SearchControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testSearchPageIsUp() {
        $this->client->request('GET', '/search');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testSearchInputIsRendering() {
        $this->client->request('GET', '/search');

        $this->assertContains('input', $this->client->getResponse()->getContent());
    }
}