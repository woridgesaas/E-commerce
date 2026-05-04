<?php

namespace App\Domain\Provisioning\ValueObject;

class ServerType
{
    private const VALID_TYPES = ['sqlsrv', 'mysql', 'pgsql'];
    private string $value;

    /**
     * @param string $serverType
     */
    public function __construct(string $serverType){
        if(!in_array($serverType, self::VALID_TYPES)){
            throw new \InvalidArgumentException("Invalid server type");
        }

        $this->value = $serverType;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isSqlServer():bool{
        return $this->value === self::VALID_TYPES[0];
    }

    public function isPostgresql():bool{
        return $this->value === self::VALID_TYPES[2];
    }
}
