<?php


namespace App\Interfaces;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface SearchControllerInterface
{
    public function __invoke(Environment $twig):Response;
}