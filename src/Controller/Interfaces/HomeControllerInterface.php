<?php


namespace App\Controller\Interfaces;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface HomeControllerInterface
{
    public function __construct(ObjectManager $manager);
    public function __invoke(Environment $twig):Response;
}