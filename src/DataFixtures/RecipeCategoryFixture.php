<?php


namespace App\DataFixtures;


use App\Entity\RecipeCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RecipeCategoryFixture extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category = [
            'Dessert',
            'Entrée',
            'Poisson',
            'Viande',
            'Vegetarien',
            'Vegan'
        ];

        foreach ($category as $value)
        {
            $recipeCategory = new RecipeCategory();

            $recipeCategory->setCategory($value);

            $manager->persist($recipeCategory);
        }

        $manager->flush();
    }
}