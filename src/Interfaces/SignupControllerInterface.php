<?php


namespace App\Interfaces;


use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

interface SignupControllerInterface
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, ObjectManager $manager);
    public function __invoke(Request $request, ValidatorInterface $validator);
    public static  function checkPassword(string $password, string $passwordCheck):bool;
}