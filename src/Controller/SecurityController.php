<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Montre;
use App\Form\ArtisteForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends Controller
{

    /**
     * @Route("/connexion")
     */
    public function login(AuthenticationUtils $utils)
    {
        return $this->render('security/login.html.twig', [
            'lastUsername' => $utils->getLastUsername(),
            'error' => $utils->getLastAuthenticationError(),
        ]);
    }


}