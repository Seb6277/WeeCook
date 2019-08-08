<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller\Interfaces;

use App\DTO\SearchDTO;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface SearchControllerInterface
{
    public function __invoke(Request $request, Environment $twig, FormFactoryInterface $formFactory, SearchDTO $searchDTO):Response;
}