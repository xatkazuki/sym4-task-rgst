<?php
/**
 * Created by PhpStorm.
 * User: xearts
 * Date: 2019/04/13
 * Time: 6:10
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class MemberType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('email')
      ->add('password')
      ->add('name')
      ->add('famillyname')
      ->add('github')
      ->add('created_at')
      ->add('updated_at');
//      ->add('save',SubmitType::class);
    ;
  }

}