<?php

namespace App\Controller;

use App\Entity\Nir as NirEntity;
use App\Form\NirType;
use App\Service\NirServiceInterface;
use App\Service\StockServiceInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NirController
 * @package App\Controller
 * @Route("/nir")
 */
class NirController extends AbstractController
{

    /** @var StockServiceInterface  */
    private $stockService;

    /**
     * @var NirServiceInterface
     */
    private $nirService;

    public function __construct(StockServiceInterface $stockService, NirServiceInterface $nirService)
    {
        $this->stockService = $stockService;
        $this->nirService = $nirService;
    }

    /**
     * @Route("/create", name="create_nir")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $nir = new NirEntity();

        $form = $this->createForm(NirType::class, $nir);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $this->nirService->create($nir);
            $this->addToStock($nir->getProducts());
        }

        return $this->render('nir/index.html.twig', [
            'form' => $form->createView(),
            'stock' => $this->stockService->getFullStock()
        ]);
    }

    /**
     * @Route("/list", name="list_nirs")
     * @return Response
     */
    public function listNirs(): Response
    {
        return $this->render('nir/list.html.twig', [
            'nirs' => $this->nirService->list()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete_nir")
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->nirService->delete($id);

        return $this->redirectToRoute('list_nirs');
    }

    /**
     * @Route("/view/{id}", name="view_nir")
     * @param int $id
     * @return Response
     */
    public function view(int $id): Response
    {
        $nir = $this->nirService->getSingleNirEntity(['id' => $id]);

        return $this->render('/nir/template.html.twig', [
            'nir' => $nir,
            'products' => $this->getNirProductModels($nir->getContent()),
            'totals' => json_decode($nir->getTotals())
        ]);
    }

    private function getNirProductModels(string $content): array
    {
        $nirProductsArr = [];

        foreach (json_decode($content) as $product){
            $nirProductsArr[] = $this->nirService->getNirProductsModel($product);
        }

        return $nirProductsArr;
    }

    /* upload products from stock */
    private function addToStock(Collection $products): void
    {
        /** @var  $product \App\Model\NirProducts */
        foreach ($products->getIterator() as $product)
        {
            $getProduct = $this->stockService->getSingleStockEntity(['hash' => $product->getHash()]);
            if($getProduct)
            {
                $newQuantity =  number_format((float)$getProduct->getQty() + $product->getQty(),
                    3, '.', '');

                $getProduct->setQty($newQuantity);
                $this->stockService->changeOrAddToStock($getProduct);
            } else
                { $this->stockService->changeOrAddToStock($getProduct); }
        }
    }

}
