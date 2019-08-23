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
use App\DTO\Interfaces\SearchDTOInterface;
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

/**
 * Class SearchController
 * @package App\Controller
 */
class SearchController implements SearchControllerInterface
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
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var SearchDTOInterface
     */
    private $searchDTO;

    /**
     * SearchController constructor.
     * @param ObjectManager $manager
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     * @param SearchDTOInterface $searchDTO
     */
    public function __construct(ObjectManager $manager,
                                Environment $twig,
                                FormFactoryInterface $formFactory,
                                SearchDTOInterface $searchDTO)
    {
        $this->manager = $manager;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->searchDTO = $searchDTO;
    }

    /**
     * @Route("/search", name="search", methods={"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(
        Request $request):Response
    {
        $imageList = [];

        $form = $this->formFactory->create(SearchRecipeFormType::class);

        $recipes = $this->manager->getRepository(Recipe::class)->findAllValid();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->searchDTO->searchString = $form->getData();
            $recipes = $this->manager->getRepository(Recipe::class)
                ->getRecipeByName((string)$this->searchDTO);
        }

        foreach ($recipes as $recipe)
        {
            array_push($imageList, RecipeUtils::getImageUri($recipe));
        }
        return new Response($this->twig->render('search/search.html.twig', [
            'recipes' => $recipes,
            'images' => $imageList,
            'form' => $form->createView()
        ]));
    }
}
