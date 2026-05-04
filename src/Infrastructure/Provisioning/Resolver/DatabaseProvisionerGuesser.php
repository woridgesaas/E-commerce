<?php

namespace App\Infrastructure\Provisioning\Resolver;



use App\Domain\Provisioning\Service\DatabaseProvisionerInterface;
use App\Domain\Provisioning\ValueObject\ServerType;
use http\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class DatabaseProvisionerGuesser
{
    /**
     * @var iterable list of DatabaseProvisionerInterface
     */
    private iterable $provisioners;
    public function __construct( #[TaggedIterator('app.database_provisioner')] iterable $provisioners){
        $this->provisioners=$provisioners;
    }

    /**
     * @param ServerType $serverType which is a ValueObject represente which sqltype
     * @return DatabaseProvisionerInterface|null
     */
    public function get(ServerType $serverType):DatabaseProvisionerInterface|null{
      foreach ($this->provisioners as $provisioner){
          if($provisioner->supports($serverType)){
              return $provisioner;
          }
      }
      throw new RuntimeException("Database provisioner not found");
    }
}
