<?php


namespace App\Interfaces;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface HomeControllerInterface
{
    public function __construct(
        ObjectManager $manager,
        ContainerInterface $container
    );

    public function __invoke(Environment $twig):Response;
}