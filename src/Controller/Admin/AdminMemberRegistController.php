<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminMemberRegistController extends AbstractController
{
    /**
     * @Route("/admin/member/regist", name="admin_memmer_regist")
     */
    public function index()
    {
        return $this->render('admin/member-regist.html.twig', [
            'controller_name' => 'AdminMemberRegistController',
        ]);
    }
}
