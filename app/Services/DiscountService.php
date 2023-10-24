<?php

namespace App\Services;

class DiscountService
{
    const DISCOUNT_20 = .20;
    protected $product;

    /**
     * @param $product
     * @return $this
     */
    public function with($product)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return string
     */
    public function applySpecialDiscount(){
        $discount = self::DISCOUNT_20 * $this->product->price;
        return number_format(($this->product->price - $discount), 2);
    }
}
