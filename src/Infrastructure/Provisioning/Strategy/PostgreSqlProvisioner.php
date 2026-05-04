<?php

namespace App\Infrastructure\Provisioning\Strategy;

use App\Domain\Provisioning\Service\DatabaseProvisionerInterface;
use App\Domain\Provisioning\ValueObject\DatabaseConfig;
use App\Domain\Provisioning\ValueObject\ServerType;
use PDO;
use Psr\Log\LoggerInterface;

class PostgreSqlProvisioner implements DatabaseProvisionerInterface
{
    public function __construct(private LoggerInterface $logger)
    {

    }
    public function createDatabase(DatabaseConfig $config): void
    {
        $host = str_replace(['http://', 'https://'], '', $config->getServerHost() );
        $port = $config->getServerPort();
        $dsn = "pgsql:host=$host;port=$port;dbname=postgres";
        try {
            $pdo = new PDO($dsn, $config->getDbUser(), $config->getDbPassword());
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            #$pdo->setAttribute(PDO::ATTR_TIMEOUT,5);

            $dbName = $config->getDbName();
            $stmt = $pdo->prepare("SELECT 1 FROM pg_database WHERE datname = ?");
            $stmt->execute([$dbName]);

            if (!$stmt->fetch()) {
                $sql = "CREATE DATABASE \"{$dbName}\"";
                $pdo->exec($sql);
            }

            $this->logger->info("Created database : " . $config->getDbName());
        } catch (\PDOException $e) {
            $this->logger->error('Provisioning failed', [
                'tenant' => $config->getDbName(),
                'host' => $host,
                'exception' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function supports(ServerType $serverType): bool
    {
        return $serverType->isPostgreSql();
    }
}
