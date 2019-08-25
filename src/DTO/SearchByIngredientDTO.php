<?php
/**
 * Created with PHPStorm
 * Date: 25/8/2019
 * Time: 3:44
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\DTO;


use App\DTO\Interfaces\SearchByIngredientDTOInterface;

class SearchByIngredientDTO implements SearchByIngredientDTOInterface
{
    public $ingredient1;
    public $ingredient2;
    public $ingredient3;
}