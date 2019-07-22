<?php

namespace App\Controller;

use App\Interfaces\HomeControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class HomeController implements HomeControllerInterface
{
    /**
     * @Route("/", name="home", methods={"GET"})
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(Environment $twig):Response
    {
        return new Response($twig->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]));
    }
}
