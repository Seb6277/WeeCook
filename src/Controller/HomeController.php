<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SingupType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HomeController extends AbstractController
{
    private $passwordEncoder;
    private $manager;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, ObjectManager $manager)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->manager = $manager;
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
    public function signup(Request $request, ValidatorInterface $validator)
    {
        $user = new User();
        $error = null;

        // Create the form before sending it to the view
        $form = $this->createForm(SingupType::class, $user);

        // Bind request to the form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // If password equal password validation
            $dataForm = $request->request->get('singup');
            if ($this->checkPassword($user->getPassword(), $dataForm['retypePassword'])) {
                // Register the user
                $user = $form->getData();
                $user->setCreatedAt(new \DateTime);
                $user->setRoles(['ROLE_USER']);

                $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

                $this->manager->persist($user);
                $this->manager->flush();

                // Login success. Redirect to homepage with user logged in
                return $this->redirectToRoute('home');
            } else {
                // Else trigger an error string and send it to the view
                $error = "Les mots de passe sont différents";
            }

        }

        /**
         * Render the page
         * signupForm => created form from createForm(SingupType::class)
         * errors => error string if password are not equal ($this->checkPassword)
         */
        return $this->render('home/signup.html.twig', [
            'signupForm' => $form->createView(),
            'errors' => $error
        ]);
    }

    /**
     * Compare the passwords field to check if they are equals and return a boolean
     * (true if is same password)
     *
     * @param $password
     * @param $passwordCheck
     * @return bool
     */
    public static function checkPassword(string $password, string $passwordCheck): bool {
        if ($password === $passwordCheck) {
            return true;
        } else {
            return false;
        }
    }
}
