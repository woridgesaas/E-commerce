<?php

namespace App\Infrastructure\Provisioning\Exception;

class ConfigurationNotFoundException extends \RuntimeException
{
    public function __construct(string $serviceKey)
    {
        $message = sprintf('Provisioning configuration not found for service: "%s"', $serviceKey);
        parent::__construct($message);
    }
}
