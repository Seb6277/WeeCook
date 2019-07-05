<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/signin", name="signin")
     */
    public function signin()
    {
        return $this->render('home/signin.html.twig', []);
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/signup", name="signup")
     */
    public function  signup()
    {
        return $this->render('home/signup.html.twig', []);
    }
}
