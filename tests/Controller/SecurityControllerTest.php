<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

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