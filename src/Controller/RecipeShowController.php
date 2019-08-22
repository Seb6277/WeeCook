<?php
/**
 * Created with PHPStorm
 * Date: 3/8/2019
 * Time: 5:46
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller;

use App\Controller\Interfaces\RecipeShowControllerInterface;
use App\Entity\Favorite;
use App\Entity\Ingredient;
use App\Entity\IngredientQuantity;
use App\Entity\Recipe;
use App\Entity\User;
use App\Utils\RecipeUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

class RecipeShowController implements RecipeShowControllerInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * RecipeShowController constructor.
     * @param ObjectManager $manager
     */
    public function __construct(SessionInterface $session, ObjectManager $manager, TokenStorageInterface $tokenStorage)
    {
        $this->manager = $manager;
        $this->tokenStorage = $tokenStorage;
        $this->session = $session;
    }

    /**
     * @Route("/show/{id}", name="recipe_show", methods={"GET", "POST"}, requirements={"id" = "\d+"})
     *
     * @param Environment $twig
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function __invoke(Request $request, Environment $twig, int $id):Response
    {
        $ingredients = [];
        $quantities = [];
        $measures = [];

        // Declare repository for each entity used
        $recipeRepository = $this->manager
            ->getRepository(Recipe::class);
        $ingredientQuantityRepository = $this->manager
            ->getRepository(IngredientQuantity::class);
        $ingredientRepository = $this->manager
            ->getRepository(Ingredient::class);
        $favoriteRepository = $this->manager
            ->getRepository(Favorite::class);

        // Retrieve recipe information for id
        $recipe = $recipeRepository->find($id);
        $user = $this->tokenStorage->getToken()->getUser();

        // Retrieve list of ingredient in a array
        $ingredientQuantity = $ingredientQuantityRepository->getAllItemsByRecipe($id);
        foreach ($ingredientQuantity as $item)
        {
            $ingredient = $item
                ->getIngredient()
                ->getId();

            $quantity = $item->getQuantity();

            array_push($ingredients, $ingredientRepository->find($ingredient)->getName());
            array_push($measures, $ingredientRepository->find($ingredient)->getMesureUnit());
            array_push($quantities, $quantity);
        }

        $existingFavorite = $favoriteRepository
            ->getFavoriteExist($user, $recipe);

        $existingFavorite === null ? $isFavorite = false : $isFavorite = true;

        if ($request->getMethod() === "POST")
        {
            if ($existingFavorite === null)
            {
                $favorite = new Favorite();
                $favorite->setUser($user);
                $favorite->setRecipe($recipe);

                $this->manager->persist($favorite);
                $this->manager->flush();

                $isFavorite = true;

                $this->session->getFlashBag()->add('info', 'Recette ajouter au favoris');
            } else {
                $this->manager->remove($existingFavorite);

                $this->manager->flush();

                $isFavorite = false;

                $this->session->getFlashBag()->add('info', 'Recette retirer des favoris');
            }
        }
        
        return new Response($twig->render('recipe/show.html.twig', [
            'controller_name' => 'RecipeShowController',
            'preparation' => $recipe->getPreparation(),
            'recipe_name' => $recipe->getName(),
            'ingredients' => $ingredients,
            'quantities' => $quantities,
            'measures' => $measures,
            'ingredient_length' => count($ingredients),
            'image1' => RecipeUtils::getImageUri($recipe),
            'is_favorite' => $isFavorite
        ]));
    }
}