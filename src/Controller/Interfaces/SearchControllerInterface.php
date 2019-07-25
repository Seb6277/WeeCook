<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller\Interfaces;


use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

interface SearchControllerInterface
{
    public function __invoke(Environment $twig):Response;
}