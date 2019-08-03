<?php
/**
 * Created with PHPStorm
 * Date: 3/8/2019
 * Time: 5:46
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller\Interfaces;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface RecipeShowControllerInterface
{
    public function __construct(ObjectManager $manager);

    public function __invoke(Request $request, Environment $twig, int $id):Response;
}