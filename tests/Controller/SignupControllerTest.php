<?php


namespace App\Tests\Controller;

use App\Controller\SignupController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class SignupControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testSignupPageIsUp()
    {
        $this->client->request('GET', '/signup');

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testSignupPageIsRenderingCorrectly()
    {
        $this->client->request('GET', '/signup');

        $this->assertContains('h2', $this->client->getResponse()->getContent());
    }

    public function testStaticPasswordRetypeValidation()
    {
        $value = SignupController::checkPassword('test', 'test');

        self::assertEquals($value, true);

        $value = SignupController::checkPassword('test', 'false');

        self::assertEquals($value, false);
    }

    public function testPasswordNotEqualCondition()
    {
        $this->client->request(
            'POST',
            '/signup', [
                'civility' => 'Mr',
                'username' => 'test',
                'email' => 'test@test',
                'password' => 'test',
                'retypePassword' => 'false'
            ]
        );

        $this->assertContains('Inscription', $this->client->getResponse()->getContent());
    }
}