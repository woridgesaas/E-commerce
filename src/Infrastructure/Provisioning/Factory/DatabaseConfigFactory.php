<?php

namespace App\Infrastructure\Provisioning\Factory;

use App\Domain\Provisioning\DatabaseConfigFactoryInterface;
use App\Domain\Provisioning\ValueObject\DatabaseConfig;
use App\Domain\Provisioning\ValueObject\ServerType;
use App\Domain\Tenant\ValueObject\Subdomain;
use App\Infrastructure\Provisioning\Exception\ConfigurationNotFoundException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class DatabaseConfigFactory implements DatabaseConfigFactoryInterface
{
    public function __construct(
        private ParameterBagInterface $params
    ) {}

    public function createFromModule(string $module , Subdomain $domain): DatabaseConfig|null{
        /** @var  - configuration .yaml  $servers */
        $servers = $this->params->get('database_servers');
        $serverKey = strtoupper($module);

        if(!isset($servers[$serverKey]))
            throw new ConfigurationNotFoundException($serverKey);

        $serverInfos = $servers[$serverKey];

        /** @var ServerType $serverType */
        $serverType = new ServerType($serverInfos['type']);
        $dbName = "woridge_" . $domain->getValue() . "_" . $module;
        return new DatabaseConfig(
            dbName: $dbName,
            serverHost: $serverInfos['host'],
            serverPort: $serverInfos['port'],
            dbUser:$serverInfos['user'],
            dbPassword: $serverInfos['password'],
            serverType: $serverType
        );

    }
}
