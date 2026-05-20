<?php

namespace App\Application\User\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class RegisterUserInput
{
    public function __construct(

        #[Assert\NotBlank(message: 'The first name is required.')]
        #[Assert\Length(
            min: 2, max: 100,
            minMessage: 'Minimum {{ limit }} characters.',
            maxMessage: 'Maximum {{ limit }} characters.'
        )]
        #[Assert\Regex(
            pattern: '/^[\p{L}\s\-]+$/u',
            message: 'The first name can only contain letters.'
        )]
        public readonly string $firstName,

        #[Assert\NotBlank(message: 'The last name is required.')]
        #[Assert\Length(
            min: 2, max: 100,
            minMessage: 'Minimum {{ limit }} characters.',
            maxMessage: 'Maximum {{ limit }} characters.'
        )]
        #[Assert\Regex(
            pattern: '/^[\p{L}\s\-]+$/u',
            message: 'The last name can only contain letters.'
        )]
        public readonly string $lastName,

        #[Assert\NotBlank(message: 'The email is required.')]
        #[Assert\Email(message: 'The email address is not valid.')]
        #[Assert\Length(max: 150)]
        public readonly string $email,

        #[Assert\NotBlank(message: 'The password is required.')]
        #[Assert\Length(
            min: 8, max: 4096,
            minMessage: 'The password must be at least {{ limit }} characters.'
        )]
        #[Assert\Regex(
            pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            message: 'The password must contain an uppercase letter, a lowercase letter and a number.'
        )]
        public readonly string $password

    ) {}
}