<?php

namespace App\Infrastructure\Persistence\Doctrine\Fixture;

use App\Domain\Subscription\Enum\SubscriptionType;
use App\Infrastructure\Persistence\Doctrine\Entity\SubscriptionDoctrine;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Persistence\ObjectManager;
class SubscriptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $subscriptions = [
            ['id' => 4, 'type' => SubscriptionType::BASIC, 'duration_in_months' => 1, 'price' => 99],
            ['id' => 5, 'type' => SubscriptionType::BASIC, 'duration_in_months' => 3, 'price' => 270],
            ['id' => 6, 'type' => SubscriptionType::BASIC, 'duration_in_months' => 6, 'price' => 500],
            ['id' => 7, 'type' => SubscriptionType::BASIC, 'duration_in_months' => 12, 'price' => 950],
            ['id' => 8, 'type' => SubscriptionType::PRO, 'duration_in_months' => 1, 'price' => 199],
            ['id' => 9, 'type' => SubscriptionType::PRO, 'duration_in_months' => 3, 'price' => 550],
            ['id' => 10, 'type' => SubscriptionType::PRO, 'duration_in_months' => 6, 'price' => 1000],
            ['id' => 11, 'type' => SubscriptionType::PRO, 'duration_in_months' => 12, 'price' => 1900],
            ['id' => 12, 'type' => SubscriptionType::PREMIUM, 'duration_in_months' => 1, 'price' => 299],
            ['id' => 13, 'type' => SubscriptionType::PREMIUM, 'duration_in_months' => 3, 'price' => 800],
            ['id' => 14, 'type' => SubscriptionType::PREMIUM, 'duration_in_months' => 6, 'price' => 1500],
            ['id' => 15, 'type' => SubscriptionType::PREMIUM, 'duration_in_months' => 12, 'price' => 2800],
        ];
        foreach ($subscriptions as $data) {
            $subscription = new SubscriptionDoctrine();

            $subscription->setType($data['type']);
            $subscription->setDurationInMonths($data['duration_in_months']);
            $subscription->setPrice($data['price']);

            $manager->persist($subscription);
        }

        $manager->flush();
    }
}
