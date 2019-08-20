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
use App\Entity\Recipe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

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
     * ProfilController constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager, TokenStorageInterface $tokenStorage)
    {
        $this->manager = $manager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Route("/profil", name="profil", methods={"GET", "POST"})
     */
    public function __invoke(Environment $twig):Response
    {
        $authoredRecipeList = $this->manager
            ->getRepository(Recipe::class)
            ->getRecipeByAuthor($this->getUser());

        dump($authoredRecipeList);

        return new Response($twig->render('profil/profil.html.twig', [
            'contribution_count' => count($authoredRecipeList),
            'nbrFavorites' => 3,
            'authored_recipe_list' => $authoredRecipeList
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
