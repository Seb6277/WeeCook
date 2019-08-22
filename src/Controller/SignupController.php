<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller;


use App\Controller\Interfaces\SignupControllerInterface;
use App\Entity\User;
use App\Form\SingupType;
use App\Utils\UserUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SignupController extends AbstractController implements SignupControllerInterface
{
    private $passwordEncoder;
    private $manager;
    private $validator;

    /**
     * SignupController constructor.
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param ObjectManager $manager
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder,
                                ObjectManager $manager,
                                ValidatorInterface $validator)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->manager = $manager;
        $this->validator = $validator;
    }

    /**
     * @Route("/signup", name="signup", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function __invoke(Request $request):Response
    {
        $user  = new User();
        $error = null;

        // Create the form before sending it to the view
        $form = $this->createForm(SingupType::class, $user);

        // Bind request to the form
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // If password equal password validation
            $dataForm = $request->request->get('singup');
            if (UserUtils::checkPassword($user->getPassword(), $dataForm['retypePassword'])) {
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
                $error = "";
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
}