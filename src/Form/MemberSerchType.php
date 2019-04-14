<?php
/**
 * Created by PhpStorm.
 * User: xearts
 * Date: 2019/04/14
 * Time: 20:07
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class MemberSerchType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('name', HiddenType::class,array())
      ->add('email', HiddenType::class,array())
      ->add('github', HiddenType::class,array())
      ->add('famillyname', HiddenType::class,array())
      ->add('password', HiddenType::class,array())
      ->add('division', HiddenType::class,array())
      ->add('created_at',DateTimeType::class,['date_widget'=>'single_text',])
      ->add('updated_at')
      ->add('division', HiddenType::class,array());

//      ->add('save',SubmitType::class);
    ;
  }

}