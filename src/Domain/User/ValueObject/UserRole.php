<?php

namespace App\Domain\User\ValueObject;

enum UserRole: string
{
    case USER = 'ROLE_USER';
    case ADMIN = 'ROLE_ADMIN';
}