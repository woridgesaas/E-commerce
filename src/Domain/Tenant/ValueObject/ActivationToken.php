<?php

namespace App\Domain\Tenant\ValueObject;

use App\Domain\User\ValueObject\UserName;

use Webmozart\Assert\Assert;
final readonly class  ActivationToken
{
    private string $value;
    public function  __construct(string $value)
    {
        \assert(is_string($value));
        Assert::length($value, 64 , "Activation Token value must be longer than 64 characters");

        $this->value = $value;
    }

    public function getValue(): string{
        return $this->value;
    }

    public function equals(ActivationToken $other): bool
    {
        return $this->value === $other->getValue();
    }
}
