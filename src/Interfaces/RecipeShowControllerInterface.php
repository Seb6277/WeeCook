<?php


namespace App\Interfaces;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface RecipeShowControllerInterface
{
    public function __invoke(Environment $twig):Response;
}