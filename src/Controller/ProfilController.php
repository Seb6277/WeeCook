<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller;

use App\Controller\Interfaces\ProfilControllerInterface;
use App\DTO\UpdateUserDTO;
use App\Entity\Recipe;
use App\Form\EditMailType;
use App\Form\EditPasswordType;
use App\Utils\RecipeUtils;
use App\Utils\UserUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;

/**
 * Class ProfilController
 * @package App\Controller
 */
class ProfilController implements ProfilControllerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * ProfilController constructor.
     * @param EntityManagerInterface $manager
     * @param TokenStorageInterface $tokenStorage
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(EntityManagerInterface $manager,
                                TokenStorageInterface $tokenStorage,
                                UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->manager = $manager;
        $this->tokenStorage = $tokenStorage;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/profil", name="profil", methods={"GET", "POST"})
     */
    public function __invoke(
        Environment $twig,
        Request $request,
        FormFactoryInterface $formFactory,
        UpdateUserDTO $updateUserDTO):Response
    {
        $user = $this->getUser();
        $authoredRecipeImage = [];
        $authoredRecipeList = $this->manager
            ->getRepository(Recipe::class)
            ->getRecipeByAuthor($user);

        foreach ($authoredRecipeList as $item)
        {
            $image = RecipeUtils::getImageUri($item);
            array_push($authoredRecipeImage, $image);
        }

        $mailForm = $formFactory->create(EditMailType::class);
        $passwordForm = $formFactory->create(EditPasswordType::class);

        $mailForm->handleRequest($request);
        $passwordForm->handleRequest($request);

        if ($mailForm->isSubmitted() && $mailForm->isValid())
        {
            $updateUserDTO = $mailForm->getData();
            $user->setEmail((string)$updateUserDTO->email);

            $this->manager->flush();
            $request->getSession()->getFlashBag()->add('info', 'Email changer avec succé !');
        }

        if ($passwordForm->isSubmitted() && $passwordForm->isValid())
        {
            $updateUserDTO = $passwordForm->getData();
            if (UserUtils::checkPassword((string)$updateUserDTO->password, (string)$updateUserDTO->retypePassword))
            {
                $user->setPassword($this->passwordEncoder->encodePassword($this->getUser(), (string)$updateUserDTO->password));
                $this->manager->flush();
                $request->getSession()->getFlashBag()->add('info', 'Mot de passe changer avec succé !');
                return new RedirectResponse('/', 302);
            } else {
                $request->getSession()->getFlashBag()->add('error', 'Les mot de passe doivent correspondre !');
            }
        }

        return new Response($twig->render('profil/profil.html.twig', [
            'contribution_count' => count($authoredRecipeList),
            'nbrFavorites' => 3,
            'authored_recipe_list' => $authoredRecipeList,
            'authored_recipe_image' => $authoredRecipeImage,
            'mail_form' => $mailForm->createView(),
            'password_form' => $passwordForm->createView()
        ]));
    }

    /**
     * @return object|string
     */
    private function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }
}
