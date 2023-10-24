<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class StockRepository
{
    /**
     * @param $product_id
     * @return \Illuminate\Database\Query\Builder\mixed
     */
    public function forProduct($product_id)
    {
        return DB::table('stocks')->find($product_id);
    }
}
