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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

interface RecipeShowControllerInterface
{
    public function __construct(SessionInterface $session, ObjectManager $manager, TokenStorageInterface $tokenStorage);

    public function __invoke(Request $request, Environment $twig, int $id):Response;
}