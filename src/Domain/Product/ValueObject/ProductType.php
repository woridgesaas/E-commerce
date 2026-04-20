<?php
// src/Domain/Product/ValueObject/ProductType.php
namespace App\Domain\Product\ValueObject;

enum ProductType: string
{
    case READER   = 'reader';
    case BADGE    = 'badge';
    case GATEWAY  = 'gateway';

    public function label(): string
    {
        return match($this) {
            self::READER   => 'Lecteur RFID',
            self::BADGE    => 'Badge RFID',
            self::GATEWAY  => 'Passerelle RFID',
        };
    }

    public static function choices(): array
    {
        return array_map(
            fn($type) => [
                'value' => $type->value,
                'label' => $type->label()
            ],
            self::cases()
        );
    }
}