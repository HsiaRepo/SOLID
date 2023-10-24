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
        StockRepository $stockRepository
    ){
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
    }

    /**
     * @param $product_id
     * @param Request $request
     * @return array|void
     * @throws ValidationException
     */
    public function execute($product_id, Request $request)
    {
        // Find the Product
        $product = $this->productRepository->getById($product_id);

        // Get the stock level
        $stock = $this->stockRepository->forProduct($product_id);

        // check the stock level
        if ($stock->quantity < 1) {
            throw ValidationException::withMessages([
                'stock' => ['we are out of stock '],
            ]);
        }

        // Apply discount
        $total = $this->applySpecialDiscount($product);

        // check for payment method
        $paymentSuccessMessage = '';

        // Attempt payment
        if ($request->has('payment_method') && $request->input('payment_method') === 'stripe') {
            $paymentSuccessMessage = $this->processPaymentViaStripe('stripe', $total);
        }

        // payment succeeded
        if (!empty($paymentSuccessMessage)) {

            // update Stock
            DB::table('stocks')
                ->where('product_id', $product_id)
                ->update([
                    'quantity' => $stock->quantity - 1
                ]);

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

    /**
     * @param $product
     * @return string
     */
    protected function applySpecialDiscount($product)
    {
        $discount = 0.20 * $product->price;
        return number_format(($product->price - $discount), 2);
    }

}
