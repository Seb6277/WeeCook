<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function editRecipe()
    {
        return $this->render('recipe/create.html.twig', [
            'nbrIngredients' => 6
        ]);
    }
}
