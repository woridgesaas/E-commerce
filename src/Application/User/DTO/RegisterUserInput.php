<?php

namespace App\Application\User\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class RegisterUserInput
{
    public function __construct(

        #[Assert\NotBlank(message: 'Le prénom est obligatoire.')]
        #[Assert\Length(min: 2, max: 100, minMessage: 'Minimum {{ limit }} caractères.')]
        #[Assert\Regex(
            pattern: '/^[\p{L}\s\-]+$/u',
            message: 'Le prénom ne peut contenir que des lettres.'
        )]
        public string $firstName,

        #[Assert\NotBlank(message: 'Le nom est obligatoire.')]
        #[Assert\Length(min: 2, max: 100, minMessage: 'Minimum {{ limit }} caractères.')]
        #[Assert\Regex(
            pattern: '/^[\p{L}\s\-]+$/u',
            message: 'Le nom ne peut contenir que des lettres.'
        )]
        public string $lastName,

        #[Assert\NotBlank(message: "L'email est obligatoire.")]
        #[Assert\Email(message: "L'adresse email '{{ value }}' est invalide.")]
        #[Assert\Length(max: 150)]
        public string $email,

        #[Assert\NotBlank(message: 'Le mot de passe est obligatoire.')]
        #[Assert\Length(
            min: 8,
            max: 4096,
            minMessage: 'Le mot de passe doit contenir au moins {{ limit }} caractères.'
        )]
        #[Assert\Regex(
            pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            message: 'Le mot de passe doit contenir une majuscule, une minuscule et un chiffre.'
        )]
        public string $password

    ) {}
}