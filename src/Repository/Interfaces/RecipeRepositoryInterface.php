<?php


namespace App\Repository\Interfaces;


use Symfony\Bridge\Doctrine\RegistryInterface;

interface RecipeRepositoryInterface
{
    public function __construct(RegistryInterface $registry);
    public function  getThreeLatest();
}