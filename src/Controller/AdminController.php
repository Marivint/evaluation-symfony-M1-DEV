<?php

namespace App\Controller;

use App\Entity\Montre;
use App\Entity\Type;
use App\Entity\Variante;
use App\File\VarianteUploader;
use App\Form\MontreForm;
use App\Form\TypeForm;
use App\Form\VarianteForm;
use App\Repository\VarianteRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
     * @Route("montre/modifier/{id}")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function montreUpdate(Request $request, Montre $m){
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
     * @Route("/montre/supprimer/{id}")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function montreDelete(Request $request, Montre $m){
        $token = $request->query->get("token");
        if(!$this->isCsrfTokenValid("MONTRE_DELETE",$token)){
            throw  $this->createAccessDeniedException();
        }
        $bdd = $this->getDoctrine()->getManager();
        $bdd->remove($m);
        $bdd->flush();
        return $this->redirectToRoute("app_admin_montre");
    }

    /**
     * @Route("/variante")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function variante(){
        $bdd = $this->getDoctrine()->getManager();
        $v = $bdd->getRepository(Variante::class);
        $liste_variante = $v->findBy(
            [], // WHERE
            ["intitule" => "ASC"]// ORDER BY]
        );
        return $this->render('admin/variante.html.twig',[
            "liste_variante" => $liste_variante
        ]);
    }

    /**
     * @Route("/variante/creer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function varianteCreate(Request $request, VarianteUploader $uploader){
        $v = new Variante();

        $form = $this->createForm(VarianteForm::class, $v);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Upload du fichier
            $uploader->upload($v);

            $bdd = $this->getDoctrine()->getManager();
            $bdd->persist($v);
            $bdd->flush();

            $this->addFlash("success","La variante à bien été ajouté");
            return $this->redirectToRoute('app_admin_variante');
        }

        return $this->render('admin/varianteForm.html.twig', [
            'variante_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/variante/modifier/{id}")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function varianteUpdate(Request $request, Variante $v, VarianteUploader $uploader){
        $form = $this->createForm(VarianteForm::class, $v);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bdd = $this->getDoctrine()->getManager();
            $uploader->upload($v);
            $bdd->flush();

            $this->addFlash("success","La variante a bien été modifié");
            return $this->redirectToRoute('app_admin_variante');
        }

        return $this->render('admin/varianteForm.html.twig', [
            'variante_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/variante/supprimer/{id}")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function varianteDelete(Request $request, Variante $v){
        $token = $request->query->get("token");
        if(!$this->isCsrfTokenValid("VARIANTE_DELETE",$token)){
            throw  $this->createAccessDeniedException();
        }

        unlink('uploads/variantes/'.$v->getFilename());

        $bdd = $this->getDoctrine()->getManager();
        $bdd->remove($v);
        $bdd->flush();
        return $this->redirectToRoute("app_admin_variante");
    }

    /**
     * @Route("/type")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function type(){
        $bdd = $this->getDoctrine()->getManager();
        $t = $bdd->getRepository(Type::class);
        $liste_type = $t->findBy(
            [], // WHERE
            ["intitule" => "ASC"]// ORDER BY]
        );
        return $this->render('admin/type.html.twig',[
            "liste_type" => $liste_type
        ]);
    }

    /**
     * @Route("/type/creer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function typeCreate(Request $request){
        $t = new Type();

        $form = $this->createForm(TypeForm::class, $t);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bdd = $this->getDoctrine()->getManager();
            $bdd->persist($t);
            $bdd->flush();

            $this->addFlash("success","Le type à bien été ajouté");
            return $this->redirectToRoute('app_admin_type');
        }

        return $this->render('admin/typeForm.html.twig', [
            'type_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("type/modifier/{id}")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function typeUpdate(Request $request, Type $t){
        $form = $this->createForm(TypeForm::class, $t);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bdd = $this->getDoctrine()->getManager();
            $bdd->flush();

            $this->addFlash("success","La montre a bien été modifié");
            return $this->redirectToRoute('app_admin_type',[
                'id' => $t->getId(),
            ]);
        }

        return $this->render('admin/typeForm.html.twig', [
            'type_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/type/supprimer/{id}")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function typeDelete(Request $request, Type $t){
        $token = $request->query->get("token");
        if(!$this->isCsrfTokenValid("TYPE_DELETE",$token)){
            throw  $this->createAccessDeniedException();
        }
        $bdd = $this->getDoctrine()->getManager();
        $bdd->remove($t);
        $bdd->flush();
        return $this->redirectToRoute("app_admin_type");
    }
}