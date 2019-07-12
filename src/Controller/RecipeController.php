<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\IngredientQuantity;
use App\Entity\Recipe;
use App\Form\EditRecipeType;
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
        $recipe = new Recipe();
        $form = $this->createForm(EditRecipeType::class, $recipe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

        }

        dump($request->request);



        return $this->render('recipe/create.html.twig', [
            'nbrIngredients' => 6,
            'recipe_form' => $form->createView()
        ]);
    }
}
