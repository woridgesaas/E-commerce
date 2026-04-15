<?php

namespace App\UI\Web\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ResetPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('password', RepeatedType::class, [
            'type'            => PasswordType::class,
            'invalid_message' => 'Passwords must match.',
            'required'        => true,
            'first_options'   => [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'Nouveau mot de passe',
                    'class'       => 'form-control',
                ],
                'constraints' => [
                    new Assert\NotBlank(message: 'The password is required.'),
                    new Assert\Length(
                        min: 8,
                        minMessage: 'The password must be at least {{ limit }} characters.'
                    ),
                    new Assert\Regex(
                        pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                        message: 'The password must contain an uppercase letter, a lowercase letter and a number.'
                    ),
                ],
            ],
            'second_options' => [
                'label' => false,
                'attr'  => [
                    'placeholder' => 'Confirmer le mot de passe',
                    'class'       => 'form-control',
                ],
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => null]);
    }
}