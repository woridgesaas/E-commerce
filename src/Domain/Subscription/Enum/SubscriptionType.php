<?php

namespace App\Domain\Subscription\Enum;

enum SubscriptionType: string
{
    case BASIC = 'BASIC';
    case PRO = 'PRO';
    case PREMIUM = 'PREMIUM';
}