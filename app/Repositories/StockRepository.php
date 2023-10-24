<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StockRepository
{
    const MINIMUM_STOCK_LEVEL = 1;

    /**
     * @param $product_id
     * @return \Illuminate\Database\Query\Builder
     */
    public function forProduct($product_id)
    {
        return DB::table('stocks')->where('product_id', $product_id)->first();
    }

    /**
     * @param $product_id
     * @return \Illuminate\Database\Query\Builder
     * @throws ValidationException
     */
    public function checkAvailability($stock){
        if ($stock->quantity < self::MINIMUM_STOCK_LEVEL) {
            throw ValidationException::withMessages([
                'stock' => ['we are out of stock '],
            ]);
        }

        return $stock;
    }

    /**
     * @param $product_id
     * @return void
     */
    public function record($product_id)
    {
        $stock = DB::table('stocks')
            ->where('product_id', $product_id);

            $stock->update([
                'quantity' => $stock->first()->quantity - 1
            ]);
    }
}
