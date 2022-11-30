<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
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
    private $OrderNumber;

      /**
     * @Gedmo\Slug(fields={"OrderNumber"})
     * @ORM\Column(length=128,unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="integer")
     */
    private $itemcount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AccountName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $itemIndex;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $itemId;

    /**
     * @ORM\Column(type="integer")
     */
    private $itemQuantity;

    /**
     * @ORM\Column(type="float")
     */
    private $prixHTVA;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTVA;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

  
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?int
    {
        return $this->OrderId;
    }

    public function setOrderId(int $OrderId): self
    {
        $this->OrderId = $OrderId;

        return $this;
    }

    public function getOrderNumber(): ?string
    {
        return $this->OrderNumber;
    }

    public function setOrderNumber(string $OrderNumber): self
    {
        $this->OrderNumber = $OrderNumber;

        return $this;
    }

    public function getItemcount(): ?int
    {
        return $this->itemcount;
    }

    public function setItemcount(int $itemcount): self
    {
        $this->itemcount = $itemcount;

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

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getItemIndex(): ?string
    {
        return $this->itemIndex;
    }

    public function setItemIndex(string $itemIndex): self
    {
        $this->itemIndex = $itemIndex;

        return $this;
    }

    public function getItemId(): ?string
    {
        return $this->itemId;
    }

    public function setItemId(string $itemId): self
    {
        $this->itemId = $itemId;

        return $this;
    }

    public function getItemQuantity(): ?int
    {
        return $this->itemQuantity;
    }

    public function setItemQuantity(int $itemQuantity): self
    {
        $this->itemQuantity = $itemQuantity;

        return $this;
    }

    public function getPrixHTVA(): ?float
    {
        return $this->prixHTVA;
    }

    public function setPrixHTVA(float $prixHTVA): self
    {
        $this->prixHTVA = $prixHTVA;

        return $this;
    }

    public function getPrixTVA(): ?float
    {
        return $this->prixTVA;
    }

    public function setPrixTVA(float $prixTVA): self
    {
        $this->prixTVA = $prixTVA;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

   
}
