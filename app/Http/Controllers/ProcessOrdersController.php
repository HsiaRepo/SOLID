<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\OrderProcessingService;
use Illuminate\Http\Request;

class ProcessOrdersController extends Controller
{
    /** @var OrderProcessingService */
    protected $orderProcessingService;

    public function __construct(OrderProcessingService $orderProcessingService)
    {
        $this->orderProcessingService = $orderProcessingService;
    }

    /**
     * Handle the incoming request.
     *
     * @param Product $product
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($product_id, Request $request)
    {
        $this->validate($request, [
            'payment_method' => 'required | string'
        ]);

        $response = $this->orderProcessingService->execute($product_id, $request);
        return response()->json($response);
    }
}
