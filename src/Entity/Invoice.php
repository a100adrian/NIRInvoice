<?php

namespace App\Entity;

use App\Model\Products;
use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $s_noroc;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $s_bank_account;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $s_bank_name;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $s_phone;

    /**
     * @ORM\Column(type="integer")
     */
    private $invoice_number;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $invoice_serie;

    /**
     * @ORM\Column(type="date")
     */
    private $invoice_issue_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $s_name;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $s_cif;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $s_address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $s_email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $issuer_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $shipp_delegated_name;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $ci_serie;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $ci_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $payment_type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $delivery_method;

    /**
     * @ORM\Column(type="date")
     */
    private $invoice_due_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $delivery_date_time;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ci_issuer_name;

    /**
     * @ORM\Column(type="text")
     */
    private $billed_products;

    /**
     * @ORM\Column(type="float")
     */
    private $total_without_vat;

    /**
     * @ORM\Column(type="float")
     */
    private $total_with_vat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $b_name;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $b_noroc;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $b_cif;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $b_bank_account;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $b_bank_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $b_address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $b_county;

    private $billed_products_models;

    public function __construct()
    {
        $this->billed_products_models = new ArrayCollection();
    }

    public function setBilledProductsModels(ArrayCollection $billed_products): self
    {
        $this->billed_products_models = $billed_products;

        return $this;
    }

    /**
     * @param Products $products
     * @return Invoice
     * @internal param $App /Model/Products $products
     */
    public function addBilledProductsModels(Products $products): self
    {
        if(!$this->billed_products_models->contains($products))
        {
            $this->billed_products_models[] = $products;
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getBilledProductsModels(): Collection
    {
        return $this->billed_products_models;
    }

    public function removeBilledProductsModels(Products $products): self
    {
        $this->billed_products_models->removeElement($products);

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSNoroc(): ?string
    {
        return $this->s_noroc;
    }

    public function setSNoroc(string $s_noroc): self
    {
        $this->s_noroc = $s_noroc;

        return $this;
    }

    public function getSBankAccount(): ?string
    {
        return $this->s_bank_account;
    }

    public function setSBankAccount(string $s_bank_account): self
    {
        $this->s_bank_account = $s_bank_account;

        return $this;
    }

    public function getSBankName(): ?string
    {
        return $this->s_bank_name;
    }

    public function setSBankName(string $s_bank_name): self
    {
        $this->s_bank_name = $s_bank_name;

        return $this;
    }

    public function getSPhone(): ?string
    {
        return $this->s_phone;
    }

    public function setSPhone(string $s_phone): self
    {
        $this->s_phone = $s_phone;

        return $this;
    }

    public function getInvoiceNumber(): ?int
    {
        return $this->invoice_number;
    }

    public function setInvoiceNumber(int $invoice_number): self
    {
        $this->invoice_number = $invoice_number;

        return $this;
    }

    public function getInvoiceSerie(): ?string
    {
        return $this->invoice_serie;
    }

    public function setInvoiceSerie(string $invoice_serie): self
    {
        $this->invoice_serie = $invoice_serie;

        return $this;
    }

    public function getInvoiceIssueDate(): ?\DateTimeInterface
    {
        return $this->invoice_issue_date;
    }

    public function setInvoiceIssueDate(\DateTimeInterface $invoice_issue_date): self
    {
        $this->invoice_issue_date = $invoice_issue_date;

        return $this;
    }

    public function getSName(): ?string
    {
        return $this->s_name;
    }

    public function setSName(string $s_name): self
    {
        $this->s_name = $s_name;

        return $this;
    }

    public function getSCif(): ?string
    {
        return $this->s_cif;
    }

    public function setSCif(string $s_cif): self
    {
        $this->s_cif = $s_cif;

        return $this;
    }

    public function getSAddress(): ?string
    {
        return $this->s_address;
    }

    public function setSAddress(string $s_address): self
    {
        $this->s_address = $s_address;

        return $this;
    }

    public function getSEmail(): ?string
    {
        return $this->s_email;
    }

    public function setSEmail(string $s_email): self
    {
        $this->s_email = $s_email;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getIssuerName(): ?string
    {
        return $this->issuer_name;
    }

    public function setIssuerName(string $issuer_name): self
    {
        $this->issuer_name = $issuer_name;

        return $this;
    }

    public function getShippDelegatedName(): ?string
    {
        return $this->shipp_delegated_name;
    }

    public function setShippDelegatedName(?string $shipp_delegated_name): self
    {
        $this->shipp_delegated_name = $shipp_delegated_name;

        return $this;
    }

    public function getCiSerie(): ?string
    {
        return $this->ci_serie;
    }

    public function setCiSerie(string $ci_serie): self
    {
        $this->ci_serie = $ci_serie;

        return $this;
    }

    public function getCiNumber(): ?string
    {
        return $this->ci_number;
    }

    public function setCiNumber(?string $ci_number): self
    {
        $this->ci_number = $ci_number;

        return $this;
    }

    public function getPaymentType(): ?string
    {
        return $this->payment_type;
    }

    public function setPaymentType(string $payment_type): self
    {
        $this->payment_type = $payment_type;

        return $this;
    }

    public function getDeliveryMethod(): ?string
    {
        return $this->delivery_method;
    }

    public function setDeliveryMethod(?string $delivery_method): self
    {
        $this->delivery_method = $delivery_method;

        return $this;
    }

    public function getInvoiceDueDate(): ?\DateTimeInterface
    {
        return $this->invoice_due_date;
    }

    public function setInvoiceDueDate(\DateTimeInterface $invoice_due_date): self
    {
        $this->invoice_due_date = $invoice_due_date;

        return $this;
    }

    public function getDeliveryDateTime(): ?\DateTimeInterface
    {
        return $this->delivery_date_time;
    }

    public function setDeliveryDateTime(\DateTimeInterface $delivery_date_time): self
    {
        $this->delivery_date_time = $delivery_date_time;

        return $this;
    }

    public function getCiIssuerName(): ?string
    {
        return $this->ci_issuer_name;
    }

    public function setCiIssuerName(?string $ci_issuer_name): self
    {
        $this->ci_issuer_name = $ci_issuer_name;

        return $this;
    }

    public function getBilledProducts(): ?string
    {
        return $this->billed_products;
    }

    public function setBilledProducts(string $billed_products): self
    {
        $this->billed_products = $billed_products;

        return $this;
    }

    public function getTotalWithoutVat(): ?float
    {
        return $this->total_without_vat;
    }

    public function setTotalWithoutVat(float $total_without_vat): self
    {
        $this->total_without_vat = number_format((float) $total_without_vat, 2, '.', '');

        return $this;
    }

    public function getTotalWithVat(): ?float
    {
        return $this->total_with_vat;
    }

    public function setTotalWithVat(float $total_with_vat): self
    {
        $this->total_with_vat =  number_format((float)$total_with_vat, 2, '.', '');

        return $this;
    }

    public function getBName(): ?string
    {
        return $this->b_name;
    }

    public function setBName(string $b_name): self
    {
        $this->b_name = $b_name;

        return $this;
    }

    public function getBNoroc(): ?string
    {
        return $this->b_noroc;
    }

    public function setBNoroc(?string $b_noroc): self
    {
        $this->b_noroc = $b_noroc;

        return $this;
    }

    public function getBCif(): ?string
    {
        return $this->b_cif;
    }

    public function setBCif(?string $b_cif): self
    {
        $this->b_cif = $b_cif;

        return $this;
    }

    public function getBBankAccount(): ?string
    {
        return $this->b_bank_account;
    }

    public function setBBankAccount(?string $b_bank_account): self
    {
        $this->b_bank_account = $b_bank_account;

        return $this;
    }

    public function getBBankName(): ?string
    {
        return $this->b_bank_name;
    }

    public function setBBankName(?string $b_bank_name): self
    {
        $this->b_bank_name = $b_bank_name;

        return $this;
    }

    public function getBAddress(): ?string
    {
        return $this->b_address;
    }

    public function setBAddress(string $b_address): self
    {
        $this->b_address = $b_address;

        return $this;
    }

    public function getBCounty(): ?string
    {
        return $this->b_county;
    }

    public function setBCounty(string $b_county): self
    {
        $this->b_county = $b_county;

        return $this;
    }
}
