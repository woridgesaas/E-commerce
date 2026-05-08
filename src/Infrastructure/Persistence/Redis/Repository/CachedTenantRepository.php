<?php

namespace App\Infrastructure\Persistence\Redis\Repository;

use App\Domain\Tenant\Entity\Tenant;
use App\Domain\Tenant\Repository\TenantRepositoryInterface;
use App\Domain\Tenant\ValueObject\Subdomain;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class CachedTenantRepository implements TenantRepositoryInterface
{

    public function __construct(
        private CacheInterface    $cache ,
        private TenantRepositoryInterface $tenantRepository,

    )
    {}
    public function findBySubdomain(Subdomain $subdomain): ?Tenant
    {
        $key='tenant_access_'.$subdomain->getValue();
        return $this->cache->get($key , function (ItemInterface $item) use ($subdomain) {
            $item->expiresAfter(3600 * 24);
            $tenant= $this->tenantRepository->findBySubdomain($subdomain);
            if($tenant === null)
                return null;
            return  $tenant;
        });

    }

    public function save(Tenant $tenant): void
    {
        // TODO: Implement save() method.
    }
}
