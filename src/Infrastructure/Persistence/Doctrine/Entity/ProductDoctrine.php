<?php

namespace App\Infrastructure\Persistence\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

#[ORM\Entity]
#[ORM\Table(name: 'products')]
class ProductDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(length: 50)]
    private string $status;

    #[ORM\Column(length: 50)]
    private string $type;

    #[ORM\Column(type: 'float')]
    private float $price;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image = null;

    /** @var Collection<int, ModuleDoctrine> */
    #[ManyToMany(targetEntity:ModuleDoctrine::class)]
    #[JoinTable(name: 'product_modules')]
    private Collection $modules;

    /** @var Collection<SubscriptionRegistryDoctrine> */
    #[OneToMany(targetEntity:SubscriptionRegistryDoctrine::class , mappedBy:'product')]
    private Collection $subscriptions;
    public function getId(): ?int            { return $this->id; }
    public function getName(): string        { return $this->name; }
    public function getDescription(): string { return $this->description; }
    public function getStatus(): string      { return $this->status; }
    public function getType(): string        { return $this->type; }
    public function getPrice(): float        { return $this->price; }
    public function getImage(): ?string      { return $this->image; }

    /**
     * @return Collection<int, ModuleDoctrine>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    /**
     * @return Collection<int , SubscriptionRegistryDoctrine>
     */
    public function getSubscriptions(): Collection{
        return $this->subscriptions;
    }
    public function setName(string $v): void        { $this->name = $v; }
    public function setDescription(string $v): void { $this->description = $v; }
    public function setStatus(string $v): void      { $this->status = $v; }
    public function setType(string $v): void        { $this->type = $v; }
    public function setPrice(float $v): void        { $this->price = $v; }
    public function setImage(?string $v): void      { $this->image = $v; }

    public function addModule(ModuleDoctrine $module): self
    {
        if (!$this->modules->contains($module)) {
            $this->modules->add($module);
        }
        return $this;
    }
}
