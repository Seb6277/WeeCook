<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SingupType;
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
        $user = new User();

        $form = new SingupType();

        return $this->render('home/signup.html.twig', [
            'signupForm' => $form->getForm()->createView()
        ]);
    }
}
