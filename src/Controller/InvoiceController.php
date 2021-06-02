<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Entity\Stock;
use App\Form\InvoiceType;
use App\Service\InvoiceServiceInterface;
use App\Service\StockServiceInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class InvoiceController
 * @package App\Controller
 * @Route("/invoice")
 */
class InvoiceController extends AbstractController
{
    /** @var  $stockService \App\Service\StockServiceInterface */
    private $stockService;

    /** @var  $invoiceService \App\Service\InvoiceServiceInterface */
    private $invoiceService;

    public function __construct(StockServiceInterface $stockService, InvoiceServiceInterface $invoiceService)
    {

        $this->stockService = $stockService;
        $this->invoiceService = $invoiceService;
    }

    /**
     * @Route("/create", name="create_invoice")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $invoice = new Invoice();

        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if($form->isSubmitted()){

            $this->invoiceService->create($invoice);
            $this->subtractFromStock($invoice->getBilledProductsModels());
        }

        return $this->render('invoice/index.html.twig', [
            'form' => $form->createView(),
            'stock' => $this->stockService->getFullStock()
        ]);
    }

    /**
     * @Route("/list", name="list_invoices")
     * @return Response
     */
    public function listInvoices(): Response
    {
        return $this->render('invoice/list.html.twig', [
            'invoices' => $this->invoiceService->list()
        ]);
    }

    /**
     * @Route("/view/{id}", name="view_invoice")
     * @param int $id
     * @return Response
     */
    public function viewInvoice(int $id): Response
    {
        $invoice = $this->invoiceService->getSingleInvoiceEntity(['id' => $id]);

        return $this->render('invoice/template.html.twig', [
            'invoice' => $invoice,
            'products' => $this->getInvoiceProductModels($invoice->getBilledProducts())
        ]);
    }

    private function getInvoiceProductModels(string $content): array
    {
        $invoiceProductsArr = [];

        foreach (json_decode($content) as $product){
            $nirProductsArr[] = $this->invoiceService->getInvoiceProductsModels($product);
        }

        return $invoiceProductsArr;
    }

    /**
     * @Route("/delete/{id}", name="delete_invoice")
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteInvoice(int $id): RedirectResponse
    {
        $this->invoiceService->delete($id);

        return $this->redirectToRoute('list_invoices');
    }

    /* Unload billed products from stock */
    private function subtractFromStock(Collection $products): void
    {
        /** @var  $product \App\Model\Products */
        foreach ($products->getIterator() as $product)
        {
            $getProduct = $this->stockService->getSingleStockEntity(['hash' => $product->getHash()]);
            if($getProduct)
            {
                $newQuantity =  number_format((float)$getProduct->getQty() - $product->getQty(),
                    3, '.', '');

                $getProduct->setQty($newQuantity);
                $this->stockService->changeOrAddToStock($getProduct);
            } else { continue; }
        }
    }
}
