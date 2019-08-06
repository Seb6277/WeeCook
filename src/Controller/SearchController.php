<?php
/**
 * Created with PHPStorm
 * Date: 3/8/2019
 * Time: 7:0
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller;

use App\Controller\Interfaces\SearchControllerInterface;
use App\Entity\Recipe;
use App\Utils\RecipeUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class SearchController implements SearchControllerInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * SearchController constructor.
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/search", name="search", methods={"GET", "POST"})
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(Environment $twig):Response
    {
        $imageList = [];

        $recipes = $this->manager->getRepository(Recipe::class)->findAll();

        foreach ($recipes as $recipe)
        {
            array_push($imageList, RecipeUtils::getImageUri($recipe));
        }
        return new Response($twig->render('search/search.html.twig', [
            'recipes' => $recipes,
            'images' => $imageList
        ]));
    }
}
