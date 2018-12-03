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
     * @Route("/")
     */
    public function index(){
        $bdd = $this->getDoctrine()->getManager();
        $m = $bdd->getRepository(Montre::class);
        $liste_montre = $m->findBy(
            [], // WHERE
            ["intitule" => "ASC"]// ORDER BY]
        );
        return $this->render('montre/index.html.twig', [
            "liste_montre" => $liste_montre,
        ]);
    }

    /**
     * @Route("/creer")
     */
    public function create(Request $request)
    {
        $m = new Montre();

        $form = $this->createForm(MontreForm::class, $m);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bdd = $this->getDoctrine()->getManager();
            $bdd->persist($m);
            $bdd->flush();

            return $this->redirectToRoute('app_montre_index');
        }

        return $this->render('montre/form.html.twig', [
            'montreForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modifier/{id}")
     */
    public function update(Request $request, Montre $m)
    {
        $form = $this->createForm(MontreForm::class, $m);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bdd = $this->getDoctrine()->getManager();
            $bdd->flush();

            return $this->redirectToRoute('app_montre_index',[
                'id' => $m->getId(),
            ]);
        }

        return $this->render('montre/form.html.twig', [
            'montreForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/{id}")
     */
    public function delete(Request $request, Montre $m){
        $token = $request->query->get("token");
        if(!$this->isCsrfTokenValid("MONTRE_DELETE",$token)){
            throw  $this->createAccessDeniedException();
        }
        $bdd = $this->getDoctrine()->getManager();
        $bdd->remove($m);
        $bdd->flush();
        return $this->redirectToRoute("app_montre_index");
    }

}