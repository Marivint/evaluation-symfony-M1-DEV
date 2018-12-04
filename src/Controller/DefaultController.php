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

        // $this->addFlash("success","test message");

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
    }


}