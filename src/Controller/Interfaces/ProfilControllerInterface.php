<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller\Interfaces;


use App\DTO\UpdateUserDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;

Interface ProfilControllerInterface
{
    public function __invoke(Environment $twig,
                             Request $request,
                             FormFactoryInterface $formFactory,
                             UpdateUserDTO $updateUserDTO):Response;

    public function __construct(EntityManagerInterface $manager,
                                TokenStorageInterface $tokenStorage,
                                UserPasswordEncoderInterface $passwordEncoder);
}