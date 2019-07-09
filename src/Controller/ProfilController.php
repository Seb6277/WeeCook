<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index()
    {
        return $this->render('profil/profil.html.twig', [
            'controller_name' => 'ProfilController',
            'nbrFavorites' => 3,
            'nbrRecipe' => 5
        ]);
    }
}