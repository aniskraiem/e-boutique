<?php

namespace App\Entity;

use App\Repository\ContactsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactsRepository::class)
 */
class Contacts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AccountID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AccountName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AddressLine1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AddressLine2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $City;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ContactName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ZipCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Country;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccountID(): ?string
    {
        return $this->AccountID;
    }

    public function setAccountID(string $AccountID): self
    {
        $this->AccountID = $AccountID;

        return $this;
    }

    public function getAccountName(): ?string
    {
        return $this->AccountName;
    }

    public function setAccountName(string $AccountName): self
    {
        $this->AccountName = $AccountName;

        return $this;
    }

    public function getAddressLine1(): ?string
    {
        return $this->AddressLine1;
    }

    public function setAddressLine1(string $AddressLine1): self
    {
        $this->AddressLine1 = $AddressLine1;

        return $this;
    }

    public function getAddressLine2(): ?string
    {
        return $this->AddressLine2;
    }

    public function setAddressLine2(?string $AddressLine2): self
    {
        $this->AddressLine2 = $AddressLine2;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->City;
    }

    public function setCity(string $City): self
    {
        $this->City = $City;

        return $this;
    }

    public function getContactName(): ?string
    {
        return $this->ContactName;
    }

    public function setContactName(string $ContactName): self
    {
        $this->ContactName = $ContactName;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->ZipCode;
    }

    public function setZipCode(string $ZipCode): self
    {
        $this->ZipCode = $ZipCode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->Country;
    }

    public function setCountry(string $Country): self
    {
        $this->Country = $Country;

        return $this;
    }
}
