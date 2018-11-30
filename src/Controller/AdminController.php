<?php

namespace App\Controller;

use App\Entity\Montre;
use App\Form\MontreForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index(){
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/montre")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function montre(){
        $bdd = $this->getDoctrine()->getManager();
        $m = $bdd->getRepository(Montre::class);
        $liste_montre = $m->findBy(
            [], // WHERE
            ["intitule" => "ASC"]// ORDER BY]
        );
    	return $this->render('admin/montre.html.twig',[
    	    "liste_montre" => $liste_montre
        ]);
    }

    /**
     * @Route("/montre/creer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function montreCreate(Request $request){
        $m = new Montre();

        $form = $this->createForm(MontreForm::class, $m);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bdd = $this->getDoctrine()->getManager();
            $bdd->persist($m);
            $bdd->flush();

            $this->addFlash("success","La montre à bien été ajouté");
            return $this->redirectToRoute('app_admin_montre');
        }

        return $this->render('admin/montreForm.html.twig', [
            'montre_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("update/{id}")
     */
    public function montreUpdate(Request $request, Montre $m)
    {
        $form = $this->createForm(MontreForm::class, $m);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bdd = $this->getDoctrine()->getManager();
            $bdd->flush();

            $this->addFlash("success","La montre a bien été modifié");
            return $this->redirectToRoute('app_admin_montre',[
                'id' => $m->getId(),
            ]);
        }

        return $this->render('admin/montreForm.html.twig', [
            'montre_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}")
     */
    public function montreDelete(Request $request, Montre $m){
        $token = $request->query->get("token");
        if(!$this->isCsrfTokenValid("GENRE_DELETE",$token)){
            throw  $this->createAccessDeniedException();
        }
        $bdd = $this->getDoctrine()->getManager();
        $bdd->remove($m);
        $bdd->flush();
        return $this->redirectToRoute("app_admin_montre");
    }
}