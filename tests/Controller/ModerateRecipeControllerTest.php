<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ModerateRecipeControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testModeratePageIsUp()
    {
        $this->client->request('GET', '/moderate');

        static::assertEquals(Response::HTTP_FOUND, $this->client->getResponse()->getStatusCode());
    }

    public function testModeratePageIsRenderingCorrectly()
    {
        $this->client->request('GET', '/moderate');

        static::assertContains('Redirecting', $this->client->getResponse()->getContent());
    }
}