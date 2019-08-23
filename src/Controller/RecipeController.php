<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller;

use App\Controller\Interfaces\RecipeControllerInterface;
use App\Entity\Ingredient;
use App\Entity\IngredientQuantity;
use App\Entity\Recipe;
use App\Entity\RecipeCategory;
use App\Form\EditRecipeType;
use App\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Twig\Environment;

/**
 * Class RecipeController
 * @package App\Controller
 */
class RecipeController implements RecipeControllerInterface
{

    /**
     * @var \App\Repository\IngredientRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private $ingredientRepository;

    /**
     * @var ObjectManager
     */
    private $manager;

    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var \App\Repository\RecipeCategoryRepository|\Doctrine\Common\Persistence\ObjectRepository
     */
    private $categoryManager;

    /**
     * RecipeController constructor.
     * @param ObjectManager $manager
     * @param TokenStorageInterface $tokenStorage
     * @param Environment $twig
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(ObjectManager $manager,
                                TokenStorageInterface $tokenStorage,
                                Environment $twig,
                                FormFactoryInterface $formFactory)
    {
        $this->manager = $manager;
        $this->ingredientRepository = $manager->getRepository(Ingredient::class);
        $this->tokenStorage = $tokenStorage;
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->categoryManager = $manager->getRepository(RecipeCategory::class);
    }

    /**
     * @Route("/create", name="creation_page", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(Request $request, FileUploader $fileUploader): Response
    {
        $ingredientInDatabase = $this->ingredientRepository->findAll();
        $recipe = new Recipe();
        $categoryList = $this->categoryManager->findAll();


        $form = $this->formFactory->create(EditRecipeType::class, $recipe);

        $form->handleRequest($request);

        // Request is an Array, containing edit_recipe Array with name and preparation parameter

        if ($form->isSubmitted() && $form->isValid())
        {
            // Store name and preparation in $recipe
            $form->getData();
            $image1 = $form['image1']->getData();
            $image1Name = $fileUploader->upload($image1);
            $recipe->setImage1($image1Name);

            // Retrieve ingredient[] and quantity[]
            $ingredients = $this->getItemsFromRequest($request, 'ingredient');
            $quantities = $this->getItemsFromRequest($request, 'quantity');

            // Setting ingredient for each ingredients in the list
            for ($i=0; $i<count($ingredients); $i++)
            {
                $ingredientQuantity = new IngredientQuantity();
                $ingredientQuantity->setIngredient($this->ingredientRepository->findOneByName($ingredients[$i]));
                $ingredientQuantity->setQuantity($quantities[$i]);
                $recipe->addIngredient($ingredientQuantity);
            }

            // Finish the Recipe object and flush all by cascade
            $recipe->setCreatedAt(new \DateTime());
            $recipe->setAuthor($this->tokenStorage->getToken()->getUser());
            $recipe->setValidation(false);
            $recipe->setCategory($request->request->get('category'));
            $this->manager->persist($recipe);
            $this->manager->flush();

            $request->getSession()->getFlashBag()->add('info', 'La recette à bien était créer !');

            return new RedirectResponse('/', 302);

        }

        return new Response($this->twig->render('recipe/create.html.twig', [
            //serialized ingredient send to React via HTML
            'ingredients' => $this->serializeToJson($ingredientInDatabase),
            'recipe_form' => $form->createView(),
            'category_list' => $categoryList
        ]));
    }

    /**
     * @param Request $request
     * @param string $option
     * @return array
     */
    private function getItemsFromRequest(Request $request, string $option): array
    {
        //create an Array to store the ingredient
        $items = $request->request->all();
        // Remove the edit_recipe key from the collection
        unset($items['edit_recipe']);
        unset($items['category']);
        // Calculate the number of ingredient in the table (table length / 2)
        $itemsInTable = count($items) / 2;
        // For each $ingredientInTable push it into new table $returnedIngredient
        $returnedItems = [];
        $i = 0;
        if ($option === 'ingredient')
        {
            for ($i; $i<$itemsInTable; $i++)
            {
                array_push($returnedItems, $items['ingredient'.$i]);
            }
        }
        elseif ($option === 'quantity')
        {
            for ($i; $i<$itemsInTable; $i++)
            {
                array_push($returnedItems, $items['quantity'.$i]);
            }
        }
        return $returnedItems;
    }

    /**
     * @param $ingredients
     * @return bool|float|int|string
     */
    private function serializeToJson($ingredients)
    {
        $items = [];
        // Create an array of object to serialize
        foreach ($ingredients as $ingredient)
        {
            array_push($items, [
                'name' => $ingredient->getName(),
                'mesure' => $ingredient->getMesureUnit()
            ]);
        }
        $encoders = [new JsonEncoder()];
        $normalizer = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizer, $encoders);
        return $serializer->serialize($items, 'json');
    }
}
