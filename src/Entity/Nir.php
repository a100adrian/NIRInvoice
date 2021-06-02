<?php

namespace App\Entity;

use App\Model\NirProducts;
use App\Repository\NirRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NirRepository::class)
 */
class Nir
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
    private $supplier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $receiver;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nir_serie;

    /**
     * @ORM\Column(type="integer")
     */
    private $nir_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $invoice_number;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reception_committee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stock_manager;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $totals;

    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return Collection|NirProducts[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    /**
     * @param NirProducts $products
     * @return Nir
     */
    public function addProducts(NirProducts $products): self
    {
        if(!$this->products->contains($products)){
            $this->products[] = $products;
        }
        return $this;
    }

    public function setProducts(ArrayCollection $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function removeBilledProducts(NirProducts $products)
    {
        $this->products->removeElement($products);

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplier(): ?string
    {
        return $this->supplier;
    }

    public function setSupplier(string $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getReceiver(): ?string
    {
        return $this->receiver;
    }

    public function setReceiver(string $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNirSerie(): ?string
    {
        return $this->nir_serie;
    }

    public function setNirSerie(string $nir_serie): self
    {
        $this->nir_serie = $nir_serie;

        return $this;
    }

    public function getNirNumber(): ?int
    {
        return $this->nir_number;
    }

    public function setNirNumber(int $nir_number): self
    {
        $this->nir_number = $nir_number;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getReceptionCommittee(): ?string
    {
        return $this->reception_committee;
    }

    public function setReceptionCommittee(?string $reception_committee): self
    {
        $this->reception_committee = $reception_committee;

        return $this;
    }

    public function getStockManager(): ?string
    {
        return $this->stock_manager;
    }

    public function setStockManager(?string $stock_manager): self
    {
        $this->stock_manager = $stock_manager;

        return $this;
    }

    public function getTotals(): ?string
    {
        return $this->totals;
    }

    public function setTotals(string $totals): self
    {
        $this->totals = $totals;

        return $this;
    }

    public function getInvoiceNumber(): ?string
    {
        return $this->invoice_number;
    }

    public function setInvoiceNumber(string $invoice_number): self
    {
        $this->invoice_number = $invoice_number;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }
}
