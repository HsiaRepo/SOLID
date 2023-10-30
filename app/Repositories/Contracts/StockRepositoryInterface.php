<?php

namespace App\Repositories\Contracts;

interface StockRepositoryInterface
{
    /**
     * @param $stock
     * @return mixed
     */
    public function checkAvailability($stock);

    /**
     * @param $product_id
     * @return mixed
     */
    public function forProduct($product_id);

    /**
     * @param $product_id
     * @return mixed
     */
    public function record($product_id);
}
