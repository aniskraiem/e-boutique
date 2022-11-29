<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"Orders:read"}},
 *     denormalizationContext={"groups"={"Orders:write"}}
 * )
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
      * @Groups("Orders:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
      * @Groups({"Orders:read", "Orders:write"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Orders:read", "Orders:write"})

     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Orders:read", "Orders:write"})

     */
    private $pays;

    /**
     * @ORM\Column(type="integer")
           * @Groups({"Orders:read", "Orders:write"})

     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
           * @Groups({"Orders:read", "Orders:write"})

     */
    private $ville;

    /**
     * @ORM\Column(type="integer")
           * @Groups({"Orders:read", "Orders:write"})

     */
    private $itemCount;

    /**
     * @ORM\Column(type="string", length=255)
           * @Groups({"Orders:read", "Orders:write"})

     */
    private $itemIndex;

    /**
     * @ORM\Column(type="integer")
           * @Groups({"Orders:read"})

     */
    private $itemId;

    /**
     * @ORM\Column(type="integer")
           * @Groups({"Orders:read", "Orders:write"})

     */
    private $itemQuantity;

    /**
     * @ORM\Column(type="float")
           * @Groups({"Orders:read", "Orders:write"})

     */
    private $prixHTVA;

    /**
     * @ORM\Column(type="float")
           * @Groups({"Orders:read", "Orders:write"})

     */
    private $prixTVA;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
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

    public function getItemCount(): ?int
    {
        return $this->itemCount;
    }

    public function setItemCount(int $itemCount): self
    {
        $this->itemCount = $itemCount;

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

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function setItemId(int $itemId): self
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
}
