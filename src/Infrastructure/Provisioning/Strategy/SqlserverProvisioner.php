<?php

namespace App\Infrastructure\Provisioning\Strategy;

use App\Domain\Provisioning\Service\DatabaseProvisionerInterface;
use App\Domain\Provisioning\ValueObject\DatabaseConfig;
use App\Domain\Provisioning\ValueObject\ServerType;
use PDO;
use Psr\Log\LoggerInterface;

class SqlserverProvisioner implements DatabaseProvisionerInterface
{
    public function  __construct(private  LoggerInterface $logger)
    {

    }
    public function createDatabase(DatabaseConfig $config): void
    {
        $host = str_replace(['http://', 'https://'], '', $config->getServerHost() );
        $host= str_replace(':', ',', $host);
        $dsn = "sqlsrv:Server=$host;Database=master;TrustServerCertificate=true;Encrypt=true;";
        echo $dsn . "\n";
        try {
            $pdo = new PDO($dsn, $config->getDbUser(), $config->getDbPassword());
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            #$pdo->setAttribute(PDO::ATTR_TIMEOUT,5);
            $sql = "IF NOT EXISTS (SELECT 1 FROM sys.databases WHERE name = '{$config->getDbName()}')
                    CREATE DATABASE [{$config->getDbName()}]";
            $pdo->exec($sql);
            $this->logger->info('Created database : ' . $config->getDbName());
        } catch (\PDOException $e) {
            $this->logger->error('Provisioning failed', [
                'tenant' => $config->getDbName(),
                'host' => $host,
                'exception' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function supports(ServerType $serverType): bool{
        return $serverType->isSqlServer();
    }
}
