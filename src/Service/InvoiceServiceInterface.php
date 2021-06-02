<?php

namespace App\Service;


use App\Entity\Invoice as InvoiceEntity;
use App\Model\Products;

interface InvoiceServiceInterface
{
    public function create(InvoiceEntity $invoice): void;
    public function list(): array;
    public function view(int $id): ?InvoiceEntity;
    public function delete(int $id): void;
    public function getSingleInvoiceEntity(array $param): ?InvoiceEntity;
    public function getInvoiceProductsModels(\stdClass $product): Products;
}