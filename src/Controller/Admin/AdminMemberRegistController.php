<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\MemberType;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminMemberRegistController extends AbstractController
{
    /**
     * @Route("/admin/member/regist", name="admin_memmer_regist")
     */
    public function index(Request $request,UserPasswordEncoderInterface $encoder)
    {

      $member = new User();
      $member->setCreatedAt(new \DateTime());
      $member->setUpdatedAt(new \DateTime());

      echo'<pre>';
      var_dump(new \DateTime());
      echo'</pre>';

      $form = $this->createForm(MemberType::class,$member);
//      $form->add('created_time','datetime',['date_widget' => 'text']);
//      $form->add('updated_at',,array());
      $form->add('save', SubmitType::class);
      $form->handleRequest($request);

      /**
       * password入力に関して平文をhashに変換
       */
      $plainPassword = $form->get('password')->getData();
      $encoded = $encoder->encodePassword($member, $plainPassword);
      $member->setPassword($encoded);

      if($form->isSubmitted() && $form->isValid()){
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($member);
        $entityManager->flush();

        return $this->redirectToRoute('admin_memmer_show');
      }


      return $this->render('admin/member-regist.html.twig', [
        'controller_name' => 'AdminMemberRegistController',
        'form' => $form->createView(),
//        'CreatedAt' => $CreatedAt = new \DateTime(),
//        'UpdatedAt' => $UpdatedAt = new \DateTime(),
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
   * @Route("/admin/member/show/{user_name}", name="admin_memmer_show_user", methods={"GET","POST"})
   */
  public function showUser(Request $request, $user_name)
  {
    $entityManager=$this->getDoctrine()->getManager();
    $memberData = $this->getDoctrine()
      ->getRepository(User::class)
      ->findBy(
        array(
          'name' => $user_name
        )
      );

    return $this->render('admin/member-show.html.twig', [
      'controller_name' => 'AdminMemberRegisttController',
      'MemberList' => $memberData,
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
