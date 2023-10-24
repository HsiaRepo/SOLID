<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class StockRepository
{
    /**
     * @param $product_id
     * @return \Illuminate\Database\Query\Builder
     */
    public function forProduct($product_id)
    {
        return DB::table('stocks')->where('product_id', $product_id)->first();
    }
}
