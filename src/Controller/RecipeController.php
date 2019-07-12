<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\IngredientQuantity;
use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    private $recipeIngredients = ['beurre', 'oeuf', 'sel', 'poivre', 'piment'];

    /**
     * @Route("/show", name="recipe_show")
     */
    public function show()
    {
        return $this->render('recipe/show.html.twig', [
            'controller_name' => 'RecipeController',
            'listIngredients' => $this->recipeIngredients
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/moderate", name="moderation_page")
     */
    public function moderate()
    {
        return $this->render('recipe/moderate.html.twig', [
            'listIngredients' => $this->recipeIngredients
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/create", name="creation_page")
     */
    public function editRecipe(Request $request): Response
    {
        // Test if the form is submitted with the length of the request
        // If request length = 0 the method was GET so the publish button was not clicked
        if (!$request->request->count() == 0)
        {
            //Create a new empty recipe
            $recipe = new Recipe();
            $ingredient = new Ingredient();
            $ingredient_quantity = new IngredientQuantity();
            // Retrieve the entire request array
            $data = $request->request;
            // Place different parts into object
            $recipe->setName($data->get('recipe_name'));
            $recipe->setPreparation($data->get('preparation'));
            //
            $ingredient->setName($data->get('ingredient0'));
            $ingredient_quantity->setQuantity($data->get('quantity0'));
            dump($recipe);
            dump($ingredient);
            dump($ingredient_quantity);
        }

        return $this->render('recipe/create.html.twig', [
            'nbrIngredients' => 6
        ]);
    }
}
