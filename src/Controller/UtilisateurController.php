<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Montre;
use App\Entity\Utilisateur;
use App\Form\ArtisteForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/utilisateur")
 */
class UtilisateurController extends Controller
{

    /**
     * @Route("/{id}")
     */
    public function index(Utilisateur $u)
    {
        return $this->render('utilisateur/index.html.twig', [
            "utilisateur" => $u
        ]);

    }
}