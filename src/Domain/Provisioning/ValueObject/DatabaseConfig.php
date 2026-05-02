<?php

namespace App\Domain\Provisioning\ValueObject;

final readonly class   DatabaseConfig
{
    public function __construct(
        private string $dbName,
        private string $serverHost,
        private int $serverPort,
        private string $dbUser,
        private string $dbPassword,
        private ServerType $serverType
    )
    {
        if (empty($dbName) || !preg_match('/^[a-zA-Z0-9_\-]+$/', $dbName)) {
            throw new \InvalidArgumentException("Invalid Database name.");
        }

        if(empty($serverHost) || !str_starts_with($serverHost, 'woridge')) {
            throw new \InvalidArgumentException("Invalid Server Host name.");
        }
    }

    /**
     * @return string
     */
    public function getDbName(): string
    {
        return $this->dbName;
    }

    /**
     * @return string
     */
    public function getDbPassword(): string
    {
        return $this->dbPassword;
    }

    /**
     * @return string
     */
    public function getDbUser(): string
    {
        return $this->dbUser;
    }

    /**
     * @return string
     */
    public function getServerHost(): string
    {
        return $this->serverHost;
    }

    public function getServerType(): ServerType{
        return $this->serverType;
    }

    /**
     * @return int
     */
    public function getServerPort(): int{
        return $this->serverPort;
    }

}
