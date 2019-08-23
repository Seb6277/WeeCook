<?php
/**
 * Created with PHPStorm
 * Date: 23/8/2019
 * Time: 10:23
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Tests\Utils;


use App\Entity\Recipe;
use App\Utils\RecipeUtils;
use PHPUnit\Framework\TestCase;

class RecipeUtilsTest extends TestCase
{
    public function testGetHomeImageURI()
    {
        $recipeArray = [];
        for ($i=0; $i<2; $i++)
        {
            $recipe = new Recipe();
            $recipe->setImage1((string)$i);
            array_push($recipeArray, $recipe);
        }
        $this->assertEquals(RecipeUtils::getHomeImageUri($recipeArray, 1), '/uploads/images/1');
    }

    public function testGetImageURI()
    {
        $recipe = new Recipe();
        $recipe->setImage1('test');
        $this->assertEquals(RecipeUtils::getImageUri($recipe), '/uploads/images/test');
    }
}