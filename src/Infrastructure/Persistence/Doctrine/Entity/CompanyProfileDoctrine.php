<?php

namespace App\Infrastructure\Persistence\Doctrine\Entity;

use App\Infrastructure\Persistence\Doctrine\Repository\DoctrineCompanyProfileRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: DoctrineCompanyProfileRepository::class)]
#[ORM\Table(name: 'company_profiles')]
class CompanyProfileDoctrine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 100)]
    private ?string $companyEmail = null;

    #[ORM\Column(length: 20)]
    private ?string $phone = null;

    #[ORM\OneToOne(mappedBy: 'company', cascade: ['persist'])]
    private ?SubscriptionRegistryDoctrine $subscriptionRegistry = null;

    #[ORM\OneToOne(targetEntity: UserDoctrine::class, inversedBy: 'companyProfile')]
    private ?UserDoctrine $ceo=null;
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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string|null $adresse
     */

    /**
     * @return UserDoctrine|null
     */
    public function getCeo(): ?UserDoctrine {
        return $this->ceo;
    }
    public function setAdresse(?string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string|null
     */
    public function getCompanyEmail(): ?string
    {
        return $this->companyEmail;
    }

    /**
     * @param string|null $companyEmail
     */
    public function setCompanyEmail(?string $companyEmail): void
    {
        $this->companyEmail = $companyEmail;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return SubscriptionRegistryDoctrine|null
     */
    public function getSubscriptionRegistry(): ?SubscriptionRegistryDoctrine
    {
        return $this->subscriptionRegistry;
    }

    /**
     * @param SubscriptionRegistryDoctrine|null $subscriptionRegistry
     */
    public function setSubscriptionRegistry(?SubscriptionRegistryDoctrine $subscriptionRegistry): void
    {
        $this->subscriptionRegistry = $subscriptionRegistry;
    }

    /**
     * @param UserDoctrine $ceo
     * @return void
     */
    public function setCeo(UserDoctrine $ceo): void
    {
        $this->ceo = $ceo;
    }


}
