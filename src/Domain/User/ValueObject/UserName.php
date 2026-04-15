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
            throw new InvalidUserNameException('The name cannot be empty.');
        }

        if (mb_strlen($value) < 2 || mb_strlen($value) > 100) {
            throw new InvalidUserNameException('The name must be between 2 and 100 characters.');
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}