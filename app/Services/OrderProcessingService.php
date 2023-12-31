<?php

namespace App\Services;


use App\Patterns\Discounts\TwentyPercentDiscount;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\StockRepositoryInterface;
use App\Repositories\MysqlProductRepository;
use App\Repositories\MysqlStockRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderProcessingService
{
    /** @var MysqlProductRepository */
    protected $productRepository;
    /** @var MysqlStockRepository */
    protected $stockRepository;
    /** @var DiscountService */
    protected $discountService;
    /** @var Payable */
    protected $payable;


    public function __construct(
        ProductRepositoryInterface $productRepository,
        StockRepositoryInterface   $stockRepository,
        Payable $payable

    )
    {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
        $this->payable = $payable;
    }

    public function execute($product_id)
    {
        $product = $this->productRepository->getById($product_id);

        $stock = $this->stockRepository->forProduct($product_id);

        $this->stockRepository->checkAvailability($stock);

        $total = DiscountService::make(new TwentyPercentDiscount)->with($product)->apply();

        $paymentSuccessMessage = $this->payable->process($total);

        $this->stockRepository->record($product_id);

        return [
            'payment_message' => $paymentSuccessMessage,
            'discounted_price' => $total,
            'original_price' => $product->price,
            'message' => 'Thank you, your order is being processed'
        ];

    }


}
