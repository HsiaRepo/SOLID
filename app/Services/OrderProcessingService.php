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
        ProductRepository $productRepository,
        StockRepository   $stockRepository,
        DiscountService   $discountService
    )
    {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
        $this->discountService = $discountService;
    }

    /**
     * @param $product_id
     * @param Request $request
     * @return array|void
     * @throws ValidationException
     */
    public function execute($product_id, Request $request)
    {
        $product = $this->productRepository->getById($product_id);

        $stock = $this->stockRepository->forProduct($product_id);

        $this->stockRepository->checkAvailability($product_id);

        $total = $this->discountService->with($product)->applySpecialDiscount();

        $paymentSuccessMessage = $this->processPaymentViaStripe('stripe', $total);

        // payment succeeded
        if (!empty($paymentSuccessMessage)) {

            $this->stockRepository->record($product_id);

            return [
                'payment_message' => $paymentSuccessMessage,
                'discounted_price' => $total,
                'original_price' => $product->price,
                'message' => 'Thank you, your order is being processed'
            ];
        }

    }

    /**
     * @param $provider
     * @param $total
     * @return string
     */
    protected function processPaymentViaStripe($provider, $total)
    {
        $price = "£{$total}";
        return 'Processing payment of ' . $price . ' through ' . $provider;
    }
}
