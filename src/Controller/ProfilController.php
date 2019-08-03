<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Controller;

use App\Controller\Interfaces\ProfilControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ProfilController implements ProfilControllerInterface
{
    /**
     * @Route("/profil", name="profil", methods={"GET", "POST"})
     */
    public function __invoke(Environment $twig):Response
    {
        return new Response($twig->render('profil/profil.html.twig', [
            'controller_name' => 'ProfilController',
            'nbrFavorites' => 3,
            'nbrRecipe' => 5
        ]));
    }
}
