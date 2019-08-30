<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\MasterDataType;
use App\Form\MemberType;
use App\Form\MemberSerchType;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminMemberRegistController extends AbstractController
{
    /**
     * @Route("/admin/member/regist", name="admin_member_regist", methods={"GET","POST"})
     */
    public function index(Request $request,UserPasswordEncoderInterface $encoder)
    {

      $member = new User();
      $member->setCreatedAt(new \DateTime());
      $member->setUpdatedAt(new \DateTime());

      $form = $this->createForm(MemberType::class,$member);
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

        return $this->redirectToRoute('admin_member_show');
      }


      return $this->render('admin/member-regist.html.twig', [
        'controller_name' => 'AdminMemberRegistController',
        'form' => $form->createView(),
        ]);
    }
  /**
   * @Route("/admin/member/show", name="admin_member_show", methods={"GET","POST"})
   */
  public function show(Request $request)
  {
    $entityManager=$this->getDoctrine()->getManager();
    $memberList = $this->getDoctrine()
      ->getRepository(User::class)
      ->findAll();

    $serch_member = new User();

//    $form =$this->createForm(MemberSerchType::class,$serch_member);
    $form =$this->createForm(MasterDataType::class,$serch_member);

    $form
      ->add('id',IntegerType::class)
      ->add('serch', SubmitType::class, array('label' => 'serch'));

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){
      $user =new User();

      $id=($form->get('id')->getData());

      return $this->redirectToRoute('admin_member_show_serch_result', [
        'id' => $id,
      ]);
    }
    return $this->render('admin/member-show.html.twig', [
      'controller_name' => 'AdminMemberRegisttController',
      'MemberList' => $memberList,
      'form' => $form ->createView(),
    ]);



  }
  /**
   * @Route("/admin/member/show/{user_name}", name="admin_member_show_user", methods={"GET","POST","DELETE"})
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
    $serch_member = new User();

//    $form =$this->createForm(MemberSerchType::class,$serch_member);
    $form =$this->createForm(MasterDataType::class,$serch_member);
    $form
      ->add('id')
      ->add('serch', SubmitType::class, array('label' => 'serch'));

    return $this->render('admin/member-show.html.twig', [
      'controller_name' => 'AdminMemberRegisttController',
      'MemberList' => $memberData,
      'form' =>$form->createView(),
    ]);
  }
  /**
   * @Route("/admin/member/result", name="admin_member_show_serch_result", methods={"GET","POST"})
   */
  public function serch_result(Request $request)
  {
    $serch_member = new User();

//    $form =$this->createForm(MemberSerchType::class,$serch_member);
    $form =$this->createForm(MasterDataType::class,$serch_member);

    $form

      ->add('id',IntegerType::class)
      ->add('serch', SubmitType::class, array('label' => 'serch'));

    $form->handleRequest($request);

    echo '<pre>';

    $i =(int)$_GET['id'];

    var_dump($i);
    echo '</pre>';

    if($form->isSubmitted() && $form->isValid()) {

      $id = ($form->get('id')->getData());
//      var_dump($_GET["master_data"]["id"]);
//      $i = (int)$_GET;

//      $entityManager = $this->getDoctrine()->getManager();
      $serch_user = $this->getDoctrine()->getManager()
        ->getRepository(User::class)
        ->findBy(
          array(
            'id' => $id,
          ));
      return $this->render('admin/member-show_result.html.twig', [
        'controller_name' => 'AdminMemberRegistController',
        'MemberSerchResult'=> $serch_user,
        'form' =>$form->createView(),
      ]);
    }

    $serch_user = $this->getDoctrine()->getManager()
      ->getRepository(User::class)
      ->findBy(
        array(
          'id' => $i,
        ));

    return $this->render('admin/member-show_result.html.twig', [
      'controller_name' => 'AdminMemberRegistController',
      'form' =>$form->createView(),
      'MemberSerchResult'=> $serch_user,

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
