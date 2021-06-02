<?php

namespace App\Service;


use App\Entity\Company;
use App\Entity\Nir as NirEntity;
use App\Model\NirProducts;
use App\Repository\NirRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Nir implements NirServiceInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @var NirRepository
     */
    private $nirRepository;

    public function __construct(EntityManagerInterface $entityManager, NirRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->nirRepository = $repository;
    }

    public function create(NirEntity $nir): void
    {
        // Hard coded
        /** @var  $company \App\Entity\Company */
        $company = $this->entityManager->getRepository(Company::class)->find(1);
        foreach ($nir->getProducts() as $product)
        {
            $product->setHash($this->getHashName($product->getName()));
        }

        $serializedProducts = $this->getSerializeNirProducts($nir->getProducts(), 'json');

        $nir->setSupplier($company->getName())
            ->setNirSerie('NIR')
            ->setNirNumber($this->getNewNirNumber(['nir_serie' => 'NIR'], ['id' => 'DESC'], 1, 0))
            ->setContent($serializedProducts)
            ->setTotals($this->getTotals($nir->getProducts()));

        $this->loadNirToDb($nir);
    }

    public function delete(int $id): void
    {
        $nir = $this->getSingleNirEntity(['id' => $id]);

        $this->entityManager->remove($nir);
        $this->entityManager->flush();
    }

    public function list(): array
    {
       return $this->nirRepository->findAll();
    }

    public function view(int $id): NirEntity
    {
        return $this->getSingleNirEntity(['id' => $id]);
    }

    public function getSingleNirEntity(array $param): ?NirEntity
    {
        return $this->nirRepository->findOneBy($param);
    }

    private function getTotals(Collection $products): string
    {
        $totals = [];
        $total = 0;

        /** @var $product \App\Model\NirProducts */
        foreach ($products->getIterator() as $product)
        {
            foreach (self::TYPE as $key)
            {
                $totals[$key] = 0;

                if($key == $product->getType())
                {
                    $total += number_format((float)$product->getValue(), 2, '.', '');
                    $totals[$key] = $totals[$key] + $total;
                }
            }
        }

        return json_encode($totals);
    }

    public function getNirProductsModel(\stdClass $product): NirProducts
    {
        $model = new NirProducts();
        $model->setName($product->name);
        $model->setUm($product->um);
        $model->setType($product->type);
        $model->setQty($product->qty);
        $model->setPrice($product->price);
        $model->setValue($product->value);
        $model->setObs($product->obs);

        return $model;
    }

    private function getNewNirNumber(array $param1, array $param2, int $limit, int $offset): int
    {
        $lastNir = $this->nirRepository->findBy($param1, $param2, $limit, $offset);
        if(!$lastNir)
        {
            return 1;
        }
        /** @var  $lastInvoice \App\Entity\Nir*/
        $lastNir = $lastNir[0];

        return $lastNir->getNirNumber() + 1;
    }

    private function getSerializeNirProducts(Collection $products, string $format): string
    {
        $encoder = [new JsonEncoder()];
        $normalizer = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizer, $encoder);

        $jsonContent = $serializer->serialize($products, $format);

        return $jsonContent;
    }

    private function getHashName(string $name): string
    {
        return md5(strtoupper(trim($name)));
    }

    private function loadNirToDb(NirEntity $nir): void
    {
        $this->entityManager->persist($nir);
        $this->entityManager->flush();
    }
}