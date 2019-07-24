<?php


namespace App\Controller;

use App\Controller\Interfaces\RecipeShowControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class RecipeShowController implements RecipeShowControllerInterface
{
    // TODO: Only for test
    static $recipeIngredients = ['beurre', 'oeuf', 'sel', 'poivre', 'piment'];

    /**
     * @Route("/show", name="recipe_show", methods={"GET"})
     *
     * @param Environment $twig
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(Environment $twig):Response
    {
        return new Response($twig->render('recipe/show.html.twig', [
            'controller_name' => 'RecipeShowController',
            'listIngredients' => self::$recipeIngredients
        ]));
    }
}