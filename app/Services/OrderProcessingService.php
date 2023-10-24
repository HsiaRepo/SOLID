<?php

namespace App\Services;


use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderProcessingService
{

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(
        /** @var ProductRepository */
        ProductRepository    $productRepository,
        /** @var StockRepository */
        StockRepository      $stockRepository,
        /** @var DiscountService */
        DiscountService      $discountService,
        /** @var StripePaymentService */
        StripePaymentService $stripePaymentService
    )
    {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
        $this->discountService = $discountService;
        $this->stripePaymentService = $stripePaymentService;
    }

    /**
     * @param $product_id
     * @return array|void
     * @throws ValidationException
     */
    public function execute($product_id)
    {
        $product = $this->productRepository->getById($product_id);

        $stock = $this->stockRepository->forProduct($product_id);

        $this->stockRepository->checkAvailability($stock);

        $total = $this->discountService->with($product)->applySpecialDiscount();

        $paymentSuccessMessage = $this->stripePaymentService->process($total);

        $this->stockRepository->record($product_id);

        return [
            'payment_message' => $paymentSuccessMessage,
            'discounted_price' => $total,
            'original_price' => $product->price,
            'message' => 'Thank you, your order is being processed'
        ];

    }
}
