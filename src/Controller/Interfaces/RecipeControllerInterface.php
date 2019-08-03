<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

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