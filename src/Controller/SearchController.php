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
use App\DTO\SearchDTO;
use App\Entity\Recipe;
use App\Form\Interfaces\SearchRecipeFormTypeInterface;
use App\Form\SearchRecipeFormType;
use App\Utils\RecipeUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function __invoke(
        Request $request,
        Environment $twig,
        FormFactoryInterface $formFactory,
        SearchDTO $searchDTO):Response
    {
        $imageList = [];

        $form = $formFactory->create(SearchRecipeFormType::class);

        $recipes = $this->manager->getRepository(Recipe::class)->findAllValid();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $searchDTO->searchString = $form->getData();
            $recipes = $this->manager->getRepository(Recipe::class)
                ->getRecipeByName((string)$searchDTO);
        }

        foreach ($recipes as $recipe)
        {
            array_push($imageList, RecipeUtils::getImageUri($recipe));
        }
        return new Response($twig->render('search/search.html.twig', [
            'recipes' => $recipes,
            'images' => $imageList,
            'form' => $form->createView()
        ]));
    }
}
