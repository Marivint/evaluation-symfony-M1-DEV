<?php

namespace App\Controller;

use App\Entity\Montre;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        /*
        $bdd = $this->getDoctrine()->getManager();
        $m = $bdd->getRepository(Montre::class);
        $liste_montre = $m->findBy(
            [], // WHERE
            ["intitule" => "ASC"]// ORDER BY]
        );
        */

        $bdd = $this->getDoctrine()->getManager();

        $req = "SELECT m.id,m.intitule,m.description,v.src_image 
                FROM montre m
                JOIN  variante v
                ON   v.montres_id = ( SELECT  id
                                      FROM    variante v2
                                      WHERE   v.montres_id = m.id
                                      LIMIT 1
                                     )";

        $sql = $bdd->getConnection()->prepare($req);
        $sql->execute();

        $liste_montre = $sql->fetchAll();

        return $this->render('index.html.twig', [
            "liste_montre" => $liste_montre,
        ]);
    }


}