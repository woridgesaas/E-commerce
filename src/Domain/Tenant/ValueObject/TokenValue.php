<?php

namespace App\Domain\Tenant\ValueObject;

use App\Domain\User\ValueObject\UserName;

use Webmozart\Assert\Assert;
final readonly class  TokenValue
{
    private string $value;
    public function  __construct(string $value)
    {
        \assert(is_string($value));
        Assert::minLength($value, 23, "Activation Token value must be longer than 23 characters");

        $this->value = $value;
    }

    public function getValue(): string{
        return $this->value;
    }

    public function equals(TokenValue $other): bool
    {
        return $this->value === $other->getValue();
    }
}
