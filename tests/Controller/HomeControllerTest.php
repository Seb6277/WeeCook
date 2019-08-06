<?php
/**
 * Created with PHPStorm
 * Date: 6/8/2019
 * Time: 0:15
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Tests\Controller;

use App\Controller\HomeController;
use App\Entity\Recipe;
use App\Repository\RecipeRepository;
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
        $this->createMock(RecipeRepository::class)->method('getThreeLatest')->willReturn([]);

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testNavbarIsRenderingCorrectly() {
        $this->client->request('GET', '/');

        $this->assertContains('nav', $this->client->getResponse()->getContent());
    }
}