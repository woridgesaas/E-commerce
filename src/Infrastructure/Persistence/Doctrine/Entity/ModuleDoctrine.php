<?php

namespace App\Infrastructure\Persistence\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'modules')]
class ModuleDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $name; // ex: "Auth Service"

    #[ORM\Column(length: 50)]
    private string $serviceKey;

    #[ORM\Column(length: 50)]
    private string $serverType;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getServiceKey(): string
    {
        return $this->serviceKey;
    }

    /**
     * @param string $serviceKey
     */
    public function setServiceKey(string $serviceKey): void
    {
        $this->serviceKey = $serviceKey;
    }

    /**
     * @return string
     */
    public function getServerType(): string
    {
        return $this->serverType;
    }

    /**
     * @param string $serverType
     */
    public function setServerType(string $serverType): void
    {
        $this->serverType = $serverType;
    }

}
