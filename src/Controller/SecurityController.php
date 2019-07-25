<?php

namespace App\Controller;

use App\Controller\Interfaces\SecurityControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class SecurityController implements SecurityControllerInterface
{
    /**
     * @Route("/logout", name="logout", methods={"POST", "GET"})
     */
    public function logout()
    {
    }

    /**
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     *
     * @param AuthenticationUtils $authenticationUtils
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function login(AuthenticationUtils $authenticationUtils, Environment $twig): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return new Response($twig->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]));
    }
}
