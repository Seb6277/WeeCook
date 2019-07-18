<?php


namespace App\Tests\Controller;


use App\Controller\SecurityController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityControllerTest extends WebTestCase
{
    public function testLogoutFunctionIsEmpty()
    {
        $securityController = new SecurityController();
        $this->assertEquals(null, $securityController->logout());
    }
}