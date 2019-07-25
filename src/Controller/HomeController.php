<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller;

use App\Entity\Recipe;
use App\Controller\Interfaces\HomeControllerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;


class HomeController implements HomeControllerInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * HomeController constructor.
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/", name="home", methods={"GET"})
     *
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(Environment $twig):Response
    {
        $repository = $this->manager->getRepository(Recipe::class);
        $recipes = $repository->getThreeLatest();

        return new Response($twig->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'recipe_image_1' => $this->getImageUri($recipes, 0),
            'recipe_image_2' => $this->getImageUri($recipes, 1),
            'recipe_image_3' => $this->getImageUri($recipes, 2),
        ]));
    }

    /**
     * @param array $recipes
     * @param int $index
     * @return string
     */
    private function getImageUri(array $recipes, int $index):string
    {
        return '/uploads/images/'.$recipes[$index]->getImage1();
    }
}
