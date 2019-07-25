<?php


namespace App\Controller;

use App\Controller\Interfaces\ModerateRecipeControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ModerateRecipeController implements ModerateRecipeControllerInterface
{
    /**
     * @Route("/moderate", name="moderation_page", methods={"GET", "POST"})
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(Environment $twig):Response
    {
        return new Response($twig->render('recipe/moderate.html.twig', [
            'listIngredients' => RecipeShowController::$recipeIngredients
        ]));
    }
}