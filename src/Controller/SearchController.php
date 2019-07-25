<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller;

use App\Controller\Interfaces\SearchControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class SearchController implements SearchControllerInterface
{
    /**
     * @Route("/search", name="search", methods={"GET", "POST"})
     */
    public function __invoke(Environment $twig):Response
    {
        return new Response($twig->render('search/search.html.twig', [
            'controller_name' => 'SearchController',
            'repeat' => 0
        ]));
    }
}
