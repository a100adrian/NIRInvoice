<?php

namespace App\Service;

use App\Entity\Stock as StockEntity;
use App\Repository\StockRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class Stock implements StockServiceInterface
{
    /** @var  EntityManagerInterface */
    private $entityManager;

    /** @var  StockRepository */
    private $stockRepository;

    public function __construct(EntityManagerInterface $entityManager, StockRepository $stockRepository)
    {
        $this->entityManager = $entityManager;
        $this->stockRepository = $stockRepository;
    }

    public function getFullStock(): array
    {
        return $this->stockRepository->findAll();
    }

    public function getSingleStockEntity(array $param): ?StockEntity
    {
        $stock = $this->stockRepository->findOneBy($param);
        if($stock)
        {
            return $stock;
        }
        return null;
    }

    public function changeOrAddToStock(StockEntity $stock): void
    {
        $this->entityManager->persist($stock);
        $this->entityManager->flush();
    }

}