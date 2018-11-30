<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

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
    	return $this->render('admin/montre.html.twig');
    }
}