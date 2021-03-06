<?php
/**
 * Created by PhpStorm.
 * User: skillup_student
 * Date: 17.04.18
 * Time: 20:58
 */

namespace App\Form;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('acceptRules', CheckboxType::class);
    }


    public function getParent()
    {
       return RegistrationFormType::class;

    }

}