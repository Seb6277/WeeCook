<?php


namespace App\Controller\Interfaces;


use App\Repository\IngredientRepository;
use App\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface RecipeControllerInterface
{
    public function __construct(ObjectManager $manager);
    public function __invoke(Request $request, FileUploader $fileUploader, ObjectManager $manager):Response;
}