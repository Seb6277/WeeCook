<?php
/**
 * Created with PHPStorm
 * Date: 1/8/2019
 * Time: 2:19
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Utils\Interfaces;


use App\Entity\Recipe;

interface RecipeUtilsInterface
{
    public static function getHomeImageUri(array $recipes, int $index):string ;
    public static function getImageUri(Recipe $recipe):string ;
}