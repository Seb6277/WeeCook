<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Repository\Interfaces;


use Symfony\Bridge\Doctrine\RegistryInterface;

interface RecipeRepositoryInterface
{
    public function __construct(RegistryInterface $registry);
    public function  getThreeLatest();
}