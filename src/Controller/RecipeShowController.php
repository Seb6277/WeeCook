<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller;

use App\Controller\Interfaces\RecipeShowControllerInterface;
use App\Entity\Ingredient;
use App\Entity\IngredientQuantity;
use App\Entity\Recipe;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class RecipeShowController implements RecipeShowControllerInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * RecipeShowController constructor.
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/show/{id}", name="recipe_show", methods={"GET"})
     *
     * @param Environment $twig
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(Request $request, Environment $twig):Response
    {
        $ingredients = [];

        // Declare repository for each entity used
        $recipeRepository = $this->manager
            ->getRepository(Recipe::class);
        $ingredientQuantityRepository = $this->manager
            ->getRepository(IngredientQuantity::class);
        $ingredientRepository = $this->manager
            ->getRepository(Ingredient::class);

        // Retrieve recipe information for id
        $recipe = $recipeRepository->find($request->attributes->get('id'));

        // Retrieve list of ingredient in a array
        $ingredientQuantity = $ingredientQuantityRepository
            ->getAllItemsByRecipe($request
                ->attributes
                ->get('id'));
        foreach ($ingredientQuantity as $item)
        {
            $ingredient = $item
                ->getIngredient()
                ->getId();
            array_push($ingredients, $ingredientRepository->find($ingredient)->getName());
        }


        return new Response($twig->render('recipe/show.html.twig', [
            'controller_name' => 'RecipeShowController',
            'preparation' => $recipe->getPreparation(),
            'recipe_name' => $recipe->getName(),
            'ingredients' => $ingredients
        ]));
    }
}