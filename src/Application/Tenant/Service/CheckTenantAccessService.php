<?php

namespace App\Application\Tenant\Service;

use App\Application\Tenant\DTO\TenantAccessResponse;
use App\Domain\Tenant\Exception\TenantNotFoundException;
use App\Domain\Tenant\Repository\TenantRepositoryInterface;
use App\Domain\Tenant\ValueObject\Subdomain;

class CheckTenantAccessService
{
    public function __construct(private TenantRepositoryInterface $repository ){}

    public function execute(string $subdomainValue): ?TenantAccessResponse{
        $subdomain = new Subdomain($subdomainValue);

        $tenant = $this->repository->findBySubdomain($subdomain);

        if (!$tenant) {
            throw new TenantNotFoundException("Tenant with " . $subdomain->getValue() . " Not found");
        }

        return new TenantAccessResponse(
            exists: true,
            isAccessGranted: $tenant->hasValidAccess(),
            subdomain: $tenant->getSubdomain()->getValue(),
            status: $tenant->getStatus()->value
        );
    }
}
