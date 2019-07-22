<?php


namespace App\Interfaces;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

Interface ProfilControllerInterface
{
    public function __invoke(Environment $twig):Response;
}