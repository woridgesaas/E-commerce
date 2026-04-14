<?php

namespace App\Domain\User\ValueObject;

use App\Domain\User\Exception\InvalidUserNameException;

final class UserName
{
    private string $value;

    public function __construct(string $value)
    {
        $value = trim($value);

        if ($value === '') {
            throw new InvalidUserNameException();
        }

        if (mb_strlen($value) < 2 || mb_strlen($value) > 100) {
            throw new InvalidUserNameException('Le nom doit contenir entre 2 et 100 caractères.');
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}