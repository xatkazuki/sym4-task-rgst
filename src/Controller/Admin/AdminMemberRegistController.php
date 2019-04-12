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
  /**
   * @Route("/admin/member/show", name="admin_memmer_show")
   */
  public function show()
  {
    return $this->render('admin/member-show.html.twig', [
      'controller_name' => 'AdminMemberRegisttController',
    ]);
  }
  /**
   * @Route("/admin/member/serch", name="admin_memmer_serch")
   */
  public function serch()
  {
    return $this->render('admin/member-show.html.twig', [
      'controller_name' => 'AdminMemberRegistController',
    ]);
  }
  /**
   * @Route("/admin/member/edit", name="admin_memmer_edit")
   */
  public function edit()
  {
    return $this->render('admin/member-edit.html.twig', [
      'controller_name' => 'AdminMemberRegistController',
    ]);
  }
}
