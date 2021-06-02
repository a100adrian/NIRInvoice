<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
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
    private $name;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $cif;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $noroc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $bank_account;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bank_name;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $director;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vat;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="company")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCif(): ?string
    {
        return $this->cif;
    }

    public function setCif(string $cif): self
    {
        $this->cif = $cif;

        return $this;
    }

    public function getNoroc(): ?string
    {
        return $this->noroc;
    }

    public function setNoroc(string $noroc): self
    {
        $this->noroc = $noroc;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getBankAccount(): ?string
    {
        return $this->bank_account;
    }

    public function setBankAccount(string $bank_account): self
    {
        $this->bank_account = $bank_account;

        return $this;
    }

    public function getBankName(): ?string
    {
        return $this->bank_name;
    }

    public function setBankName(string $bank_name): self
    {
        $this->bank_name = $bank_name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(string $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getVat(): ?int
    {
        return $this->vat;
    }

    public function setVat(?int $vat): self
    {
        $this->vat = $vat;

        return $this;
    }
}
