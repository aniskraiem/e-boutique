<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $Amount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="float")
     */
    private $Discount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Item;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ItemDescription;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantity;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UnitCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UnitDescriptions;

    /**
     * @ORM\Column(type="float")
     */
    private $UnitPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $VATAmount;

    /**
     * @ORM\Column(type="float")
     */
    private $VATPercentage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->Amount;
    }

    public function setAmount(float $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->Discount;
    }

    public function setDiscount(float $Discount): self
    {
        $this->Discount = $Discount;

        return $this;
    }

    public function getItem(): ?string
    {
        return $this->Item;
    }

    public function setItem(string $Item): self
    {
        $this->Item = $Item;

        return $this;
    }

    public function getItemDescription(): ?string
    {
        return $this->ItemDescription;
    }

    public function setItemDescription(string $ItemDescription): self
    {
        $this->ItemDescription = $ItemDescription;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->Quantity;
    }

    public function setQuantity(int $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getUnitCode(): ?string
    {
        return $this->UnitCode;
    }

    public function setUnitCode(string $UnitCode): self
    {
        $this->UnitCode = $UnitCode;

        return $this;
    }

    public function getUnitDescriptions(): ?string
    {
        return $this->UnitDescriptions;
    }

    public function setUnitDescriptions(string $UnitDescriptions): self
    {
        $this->UnitDescriptions = $UnitDescriptions;

        return $this;
    }

    public function getUnitPrice(): ?float
    {
        return $this->UnitPrice;
    }

    public function setUnitPrice(float $UnitPrice): self
    {
        $this->UnitPrice = $UnitPrice;

        return $this;
    }

    public function getVATAmount(): ?float
    {
        return $this->VATAmount;
    }

    public function setVATAmount(float $VATAmount): self
    {
        $this->VATAmount = $VATAmount;

        return $this;
    }

    public function getVATPercentage(): ?float
    {
        return $this->VATPercentage;
    }

    public function setVATPercentage(float $VATPercentage): self
    {
        $this->VATPercentage = $VATPercentage;

        return $this;
    }
}
