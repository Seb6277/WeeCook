<?php


namespace App\Tests\Controller;

use App\Controller\HomeController;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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

    public function testSignupPageIsUp() {
        $this->client->request('GET', '/signup');

        static::assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testSignupPageIsRenderingCorrectly() {
        $this->client->request('GET', '/signup');

        $this->assertContains('h2', $this->client->getResponse()->getContent());
    }

    public function testStaticPasswordRetypeValidation() {
        $value = HomeController::checkPassword('test', 'test');

        self::assertEquals($value, true);

        $value = HomeController::checkPassword('test', 'false');

        self::assertEquals($value, false);
    }

    public function testPasswordNotEqualCondition()
    {
        $this->client->request(
            'POST',
            '/signup',
            ['civility' => 'Mr',
            'username' => 'test',
            'email' => 'test@test',
            'password' => 'test',
            'retypePassword' => 'false']
        );
        $this->assertContains('Inscription', $this->client->getResponse()->getContent());
    }
}