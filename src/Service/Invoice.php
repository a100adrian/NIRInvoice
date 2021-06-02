<?php

namespace App\Service;


use App\Entity\Company;
use App\Entity\Invoice as InvoiceEntity;
use App\Model\Products;
use App\Repository\CompanyRepository;
use App\Repository\InvoiceRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class Invoice implements InvoiceServiceInterface
{
    /** @var EntityManagerInterface $entityManager */
    private $entityManager;

    /** @var InvoiceRepository $invoiceRepository */
    private $invoiceRepository;

//    /** @var CompanyRepository $companyRepository */
//    private $companyRepository;

    public function __construct(EntityManagerInterface $entityManager, InvoiceRepository $invoiceRepository)
//                                CompanyRepository $companyRepository)
    {
        $this->entityManager = $entityManager;
        $this->invoiceRepository = $invoiceRepository;
//        $this->companyRepository = $companyRepository;
    }

    public function create(InvoiceEntity $invoice): void
    {
        // Hard coded, fix this
        $company = $this->entityManager->getRepository(Company::class)->find(1);

        $serializedBilledProducts = $this->getSerializeBilledProducts($invoice->getBilledProductsModels(), 'json');
        $invoice->setSName($company->getName())
                ->setSNoroc($company->getNoroc())
                ->setSCif($company->getCif())
                ->setIssuerName($company->getDirector())
                ->setInvoiceSerie('pos')
                ->setInvoiceNumber($this->getNewInvoiceNumber(['invoice_serie' => 'POS'], ['id' => 'DESC'], 1, 0))
                ->setSEmail($company->getEmail())
                ->setSAddress($company->getAddress())
                ->setSBankName($company->getBankName())
                ->setSBankAccount($company->getBankAccount())
                ->setSPhone($company->getPhone())
                ->setWebsite($company->getWebsite())
                ->setBilledProducts($serializedBilledProducts)
                ->setTotalWithoutVat($this->getTotal($serializedBilledProducts, false))
                ->setTotalWithVat($this->getTotal($serializedBilledProducts, true));

        $this->loadInvoiceToDb($invoice);
    }

    public function list(): array
    {
        return $this->invoiceRepository->findAll();
    }

    public function view(int $id): ?InvoiceEntity
    {
        return $this->getSingleInvoiceEntity(['id' => $id]);
    }

    public function delete(int $id): void
    {
        //Todo Update Stock
        $invoice = $this->getSingleInvoiceEntity(['id' => $id]);

        $this->entityManager->remove($invoice);
        $this->entityManager->flush();
    }

    public function getSingleInvoiceEntity(array $param): ?InvoiceEntity
    {
        $invoice = $this->invoiceRepository->findOneBy($param);
        if($invoice)
        {
            return $invoice;
        }
        return null;
    }

    public function getInvoiceProductsModels(\stdClass $product): Products
    {
        $model = new Products();
        $model->setName($product->name);
        $model->setUm($product->um);
        $model->setType($product->type);
        $model->setQty($product->qty);
        $model->setPrice($product->price);
        $model->setValue($product->value);

        return $model;
    }

    /*
     * if $isVat is set to true then it returns $total with vat
     */
    private function getTotal(string $JsonProducts, bool $isVat): float
    {
        $total = 0;
        /** @var $product \stdClass*/
        foreach (json_decode($JsonProducts) as $product){

            if($isVat === true)
            {
                $total = $total + $product->valueWithVat;
                break;
            }

            $total = $total + $product->value;
        }

        return number_format((float)$total, 3, '.', '');
    }

    private function getSerializeBilledProducts(Collection $products, string $format): string
    {
        $encoder = [new JsonEncoder()];
        $normalizer = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizer, $encoder);

        $jsonContent = $serializer->serialize($products, $format);

        return $jsonContent;
    }

    private function getNewInvoiceNumber(array $param1, array $param2, int $limit, int $offset): int
    {
        $lastInvoice = $this->invoiceRepository->findBy($param1, $param2, $limit, $offset);
        if(!$lastInvoice)
        {
            return 1;
        }
        /** @var  $lastInvoice \App\Entity\Invoice*/
        $lastInvoice = $lastInvoice[0];

        return $lastInvoice->getInvoiceNumber() + 1;
    }

    private function loadInvoiceToDb(InvoiceEntity $invoice):void
    {
        $this->entityManager->persist($invoice);
        $this->entityManager->flush();
    }
}