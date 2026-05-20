<?php
namespace App\Domain\Product\ValueObject;

enum ProductStatus: string
{
    case Active   = 'ACTIVE';
    case Inactive = 'INACTIVE';
}