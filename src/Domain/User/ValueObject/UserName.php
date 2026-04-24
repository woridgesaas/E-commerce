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
    throw InvalidUserNameException::becauseEmpty();
}

if (mb_strlen($value) < 2) {
    throw InvalidUserNameException::becauseTooShort($value);
}

if (mb_strlen($value) > 100) {
    throw InvalidUserNameException::becauseTooLong($value);
}
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}