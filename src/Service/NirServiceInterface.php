<?php

namespace App\Service;

use App\Entity\Nir as NirEntity;
use App\Model\NirProducts;
use Doctrine\Common\Collections\Collection;

interface NirServiceInterface
{
    const TYPE = ['inventar', 'consumabile', 'marfuri'];
    public function create(NirEntity $nir): void;
    public function delete(int $id): void;
    public function list(): array;
    public function view(int $id): NirEntity;
    public function getSingleNirEntity(array $param): ?NirEntity;
    //public function getTotals(Collection $products): string;
    public function getNirProductsModel(\stdClass $product): NirProducts;
}