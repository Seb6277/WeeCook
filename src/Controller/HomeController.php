<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SingupType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

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
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @Route("/signup", name="signup")
     */
    public function  signup(Request $request, ObjectManager $manager)
    {
        $user = new User();

        $form = $this->createForm(SingupType::class, $user);

        $form->handleRequest($request);

        //TODO: Validate the form field before registering

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setCreatedAt(new \DateTime);
            $user->setRoles(['ROLE_USER']);

            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('home/signup.html.twig', [
            'signupForm' => $form->createView()
        ]);
    }
}
