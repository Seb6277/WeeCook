<?php


namespace App\Controller\Interfaces;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

interface SecurityControllerInterface
{
    public function logout();
    public function login(AuthenticationUtils $authenticationUtils, Environment $twig):Response;
}