<?php

namespace App\Infrastructure\Persistence\Doctrine\Mapper;

use App\Domain\Tenant\Entity\ActivationToken;
use App\Domain\Tenant\Entity\Tenant;
use App\Domain\Tenant\Enum\TenantStatus;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Domain\Tenant\ValueObject\TokenValue;
use App\Domain\User\Entity\User;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\UserName;
use App\Infrastructure\Persistence\Doctrine\Entity\ActivationTokenDoctrine;
use App\Infrastructure\Persistence\Doctrine\Entity\SubscriptionRegistryDoctrine;

class TenantMapper
{
    public function toDomain(SubscriptionRegistryDoctrine $persistence): Tenant
    {
        $tenant = new Tenant(
            new Subdomain($persistence->getSubdomain()),
            $persistence->getEndDate(),
            TenantStatus::from($persistence->getStatus()),
        );

        $company = $persistence->getCompany();
        if ($company && $company->getCeo()) {
            $ceoDoctrine = $company->getCeo();

            $ceoDomain = new User(
                firstName: new UserName($ceoDoctrine->getFirstName()),
                lastName: new UserName($ceoDoctrine->getLastName()),
                email: new Email($ceoDoctrine->getEmail()),
                password: $ceoDoctrine->getPassword()
            );

            $tenant->setCeo($ceoDomain)
                ->setCompanyName($company->getName());
        }

        return $tenant;
    }

    public function toActivationDomain(ActivationTokenDoctrine  $activationToken): ActivationToken{
        return new ActivationToken(
            value: new TokenValue($activationToken->getValue()),
            expiresAt: $activationToken->getExpireAt(),
            used: $activationToken->isUsed(),
            sub: $this->toDomain($activationToken->getSubscription())
        );
    }
    public function mapToPersistence(Tenant $domain, SubscriptionRegistryDoctrine $persistence): void
    {

        foreach ($domain->getActivationTokens() as $tokenVO) {

            $tokenString = $tokenVO->getValue()->getValue();

            if (!$persistence->hasToken($tokenString)) {
                $tokenEntity = new ActivationTokenDoctrine(
                    $tokenString,
                    $tokenVO->getExpiresAt(),
                    $persistence
                );

                $persistence->addActivationToken($tokenEntity);
            }
        }
    }
}
