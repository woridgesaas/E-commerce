<?php

namespace App\Domain\Provisioning\Service;

use App\Domain\Provisioning\ValueObject\DatabaseConfig;
use App\Domain\Provisioning\ValueObject\ServerType;

interface DatabaseProvisionerInterface
{
    /**
     * @param DatabaseConfig $databaseConfig
     * @return void
     */
    public function createDatabase(DatabaseConfig $databaseConfig): void;

    /**
     * is this strategy support the given argument :)
     * @param  ServerType $serverType which is a ValueObject
     * @return bool
     */
    public function supports(ServerType $serverType): bool;
}
