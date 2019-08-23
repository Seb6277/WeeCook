<?php
/**
 * Created with PHPStorm
 * Date: 1/8/2019
 * Time: 2:17
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Utils;


use App\Utils\Interfaces\RecipeUtilsInterface;
use App\Entity\Recipe;

/**
 * Class RecipeUtils
 * @package App\Utils
 */
class RecipeUtils implements RecipeUtilsInterface
{

    /**
     * @param array $recipes
     * @param int $index
     * @return string
     */
    public static function getHomeImageUri(array $recipes, int $index): string
    {
        return '/uploads/images/'.$recipes[$index]->getImage1();
    }

    /**
     * @param Recipe $recipe
     * @return string
     */
    public static function getImageUri(Recipe $recipe): string
    {
        return '/uploads/images/'.$recipe->getImage1();
    }
}