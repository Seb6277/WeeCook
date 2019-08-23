<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class IngredientFixtures
 * @package App\DataFixtures
 */
class IngredientFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Food($faker));

        for ($i=0; $i<50; $i++)
        {
            $ingredient = new Ingredient();
            $ingredient->setName($faker->ingredient); // Hazelnut
            $unit = $this->after(" ", $faker->measurement);
            $ingredient->setMesureUnit($unit);

            $manager->persist($ingredient);
        }


        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    /**
     * @param $that
     * @param $inThat
     * @return bool|string
     */
    private function after($that, $inThat)
    {
        if (!is_bool(strpos($inThat, $that)))
        {
            return substr($inThat, strpos($inThat, $that) + strlen($that));
        }
    }
}
