<?php
/**
 * Created by PhpStorm.
 * User: xearts
 * Date: 2019/04/13
 * Time: 6:10
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
      ->add('created_at',DateTimeType::class,['date_widget'=>'single_text',])
      ->add('updated_at')
      ->add('division',ChoiceType::class,[
        'choices'  => [
          'Maybe' => null,
          'Yes' => true,
          'No' => false,
          '正社員'=>'正社員',
          '契約社員'=>'契約社員',
          '学生アルバイト'=>'学生アルバイト',
          '外国籍パートタイム'=>'外国籍パートタイム',
          '日本国籍パートタイム'=>'日本国籍パートタイム',
          '外注登録'=>'外注登録',
          '短期アルバイト'=>'短期アルバイト',
        ],
      ]);
//      ->add('save',SubmitType::class);
    ;
  }

}