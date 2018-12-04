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
    public function index(Montre $m){
        dump($m);
        return $this->render('montre/index.html.twig');
    }
        /*
        $bdd = $this->getDoctrine()->getManager();

        $req = "SELECT m.id,m.intitule,m.description,v.filename 
                FROM montre m
                JOIN  variante v
                ON   v.montres_id = ( SELECT  montres_id
                                      FROM    variante
                                      WHERE   montres_id = m.id
                                      LIMIT 1
                                     )";

        $sql = $bdd->getConnection()->prepare($req);
        $sql->execute();

        $liste_montre = $sql->fetchAll();

        return $this->render('index.html.twig', [
            "liste_montre" => $liste_montre,
        ]);


        $bdd = $this->getDoctrine()->getManager();
        $m = $bdd->getRepository(Montre::class);
        $liste_montre = $m->findBy(
            [], // WHERE
            ["intitule" => "ASC"]// ORDER BY]
        );
        return $this->render('montre/index.html.twig', [
            "liste_montre" => $liste_montre,
        ]);
        */

}