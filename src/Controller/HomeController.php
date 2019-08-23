<?php
/**
 * Created with PHPStorm
 * Date: 3/8/2019
 * Time: 7:0
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller;

use App\Entity\Recipe;
use App\Controller\Interfaces\HomeControllerInterface;
use App\Utils\RecipeUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController implements HomeControllerInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * HomeController constructor.
     * @param ObjectManager $manager
     * @param Environment $twig
     */
    public function __construct(ObjectManager $manager, Environment $twig)
    {
        $this->manager = $manager;
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="home", methods={"GET"})
     *
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke():Response
    {
        $repository = $this->manager->getRepository(Recipe::class);
        $recipes = $repository->getThreeLatest();

        return new Response($this->twig->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'recipe_image_1' => RecipeUtils::getHomeImageUri($recipes, 0),
            'recipe_image_2' => RecipeUtils::getHomeImageUri($recipes, 1),
            'recipe_image_3' => RecipeUtils::getHomeImageUri($recipes, 2),
        ]));
    }
}
