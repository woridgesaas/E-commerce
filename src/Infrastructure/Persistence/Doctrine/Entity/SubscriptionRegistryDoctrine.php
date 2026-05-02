<?php

namespace App\Infrastructure\Persistence\Doctrine\Entity;

use App\Domain\Product\Entity\Product;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;

#[ORM\Entity]
#[ORM\Table(name: 'subscriptions_registry')]
class SubscriptionRegistryDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int  $id =null;

    #[ORM\Column(type: 'string', length: 40 , unique: true , nullable: false)]
    private string $subdomain;

    #[ORM\Column(type: 'datetime_immutable' , nullable: false)]
    private \DateTimeImmutable $startDate;

    #[ORM\Column(type: 'datetime_immutable' , nullable: false)]
    private \DateTimeImmutable $endDate;

    #[ORM\Column(type: 'string', length: 100 , nullable: false)]
    private string $status;

    #[ManyToOne(targetEntity: ProductDoctrine::class)]
    #[ORM\JoinColumn(name: 'product_id', nullable: false)]
    private ProductDoctrine $product;

    #[OneToOne(targetEntity: CompanyProfileDoctrine::class)]
    #[ORM\JoinColumn(name: 'company_id', nullable: false)]
    private CompanyProfileDoctrine $company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getSubdomain(): string
    {
        return $this->subdomain;
    }

    /**
     * @return ProductDoctrine
     */
    public function getProduct(): ProductDoctrine{
        return $this->product;
    }

    /**
     * @return CompanyProfileDoctrine
     */
    public function getCompany(): CompanyProfileDoctrine{
        return $this->company;
    }

    public function setSubdomain(string $subdomain): void
    {
        $this->subdomain = $subdomain;
    }

    public function getStartDate(): \DateTimeImmutable
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeImmutable $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): \DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeImmutable $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setProduct (ProductDoctrine $pro):void
    {
        $this->product = $pro;
    }
}
