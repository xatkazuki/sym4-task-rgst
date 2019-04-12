<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\MemberType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminMemberRegistController extends AbstractController
{
    /**
     * @Route("/admin/member/regist", name="admin_memmer_regist")
     */
    public function index(Request $request)
    {

      $member = new User();
      $member->setCreatedAt(new \DateTime());
      $member->setUpdatedAt(new \DateTime());

      $form = $this->createForm(MemberType::class,$member);
//      $form->add('created_at',HiddenType::class,array());
//      $form->add('updated_at',HiddenType::class,array());
      $form->add('save', SubmitType::class);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($member);
        $entityManager->flush();

        return $this->redirectToRoute('admin_memmer_show');
      }


      return $this->render('admin/member-regist.html.twig', [
          'controller_name' => 'AdminMemberRegistController',
          'form' => $form->createView(),
        ]);
    }
  /**
   * @Route("/admin/member/show", name="admin_memmer_show")
   */
  public function show()
  {
    $entityManager=$this->getDoctrine()->getManager();
    $memberList = $this->getDoctrine()
      ->getRepository(User::class)
      ->findAll();

    return $this->render('admin/member-show.html.twig', [
      'controller_name' => 'AdminMemberRegisttController',
      'MemberList' => $memberList,
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
