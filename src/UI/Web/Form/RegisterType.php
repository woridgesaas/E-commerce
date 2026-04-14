<?php

namespace App\UI\Web\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label'       => 'Prénom',
                'required'    => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le prénom est obligatoire.']),
                    new Assert\Length(['min' => 2, 'max' => 100]),
                ],
                'attr' => ['placeholder' => 'Votre prénom'],
            ])
            ->add('lastName', TextType::class, [
                'label'       => 'Nom',
                'required'    => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le nom est obligatoire.']),
                    new Assert\Length(['min' => 2, 'max' => 100]),
                ],
                'attr' => ['placeholder' => 'Votre nom'],
            ])
            ->add('email', EmailType::class, [
                'label'       => 'Adresse email',
                'required'    => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => "L'email est obligatoire."]),
                    new Assert\Email(['message' => "Email invalide."]),
                ],
                'attr' => ['placeholder' => 'exemple@mail.com'],
            ])
            ->add('password', RepeatedType::class, [
                'type'            => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent correspondre.',
                'required'        => true,
                'first_options'   => [
                    'label' => 'Mot de passe',
                    'constraints' => [
                        new Assert\NotBlank(['message' => 'Le mot de passe est obligatoire.']),
                        new Assert\Length([
                            'min'        => 8,
                            'minMessage' => 'Minimum {{ limit }} caractères.',
                        ]),
                        new Assert\Regex([
                            'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                            'message' => 'Doit contenir majuscule, minuscule et chiffre.',
                        ]),
                    ],
                ],
                'second_options'  => ['label' => 'Confirmer le mot de passe'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null, // on mappe manuellement vers le DTO
        ]);
    }
}