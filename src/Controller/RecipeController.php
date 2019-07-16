<?php

namespace App\Controller;

use App\Entity\IngredientQuantity;
use App\Entity\Recipe;
use App\Form\EditRecipeType;
use App\Repository\IngredientRepository;
use App\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    // TODO: Only for test, to delete once there are real recipe
    private $recipeIngredients = ['beurre', 'oeuf', 'sel', 'poivre', 'piment'];

    private $ingredientRepository;
    private $manager;

    public function __construct(IngredientRepository $repository, ObjectManager $manager)
    {
        $this->ingredientRepository = $repository;
        $this->manager = $manager;
    }

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
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param ObjectManager $manager
     * @return Response
     * @throws \Exception
     * @Route("/create", name="creation_page")
     */
    public function editRecipe(Request $request, FileUploader $fileUploader, ObjectManager $manager): Response
    {
        $recipe = new Recipe();

        $form = $this->createForm(EditRecipeType::class, $recipe);

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
            for ($i=0; $i<count($ingredients); $i++)
            {
                $ingredientQuantity = new IngredientQuantity();
                $ingredientQuantity->setIngredient($this->ingredientRepository->findOneByName($ingredients[$i]));
                $ingredientQuantity->setQuantity($quantities[$i]);
                $recipe->addIngredient($ingredientQuantity);
            }
            $recipe->setCreatedAt(new \DateTime());
            $recipe->setAuthor($this->getUser());
            $manager->persist($recipe);
            $manager->flush();

            $this->redirectToRoute('home');

        }

        return $this->render('recipe/create.html.twig', [
            'nbrIngredients' => 6,
            'recipe_form' => $form->createView()
        ]);
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
}
