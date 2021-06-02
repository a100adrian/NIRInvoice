<?php

namespace App\Service;


use App\Entity\Stock as StockEntity;

interface StockServiceInterface
{
    function getFullStock(): array;
    function getSingleStockEntity(array $param): ?StockEntity;

    /**
     * @param StockEntity $stock
     */
    function changeOrAddToStock(StockEntity $stock): void;
}