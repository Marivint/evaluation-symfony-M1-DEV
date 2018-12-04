<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Montre;
use App\Form\ArtisteForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/montre")
 */
class MontreController extends Controller
{

    /**
     * @Route("/{id}")
     */
    public function index(Montre $m)
    {
        $bdd = $this->getDoctrine()->getManager();

        $id = $m->getId();

        $req = "SELECT v.intitule,v.description,v.prix,v.filename
                FROM variante v
                WHERE v.montres_id = $id";

        $sql = $bdd->getConnection()->prepare($req);
        $sql->execute();

        $liste_variante = $sql->fetchAll();

        return $this->render('montre/index.html.twig', [
            "montre" => $m,
            "liste_variante" => $liste_variante,
        ]);

    }
}