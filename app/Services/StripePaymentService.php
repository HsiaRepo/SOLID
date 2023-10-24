<?php

namespace App\Services;

class StripePaymentService
{
    /**
     * @param $total
     * @return string
     */
    public function process($total){
        $price = "£{$total}";
        return 'Processing payment of ' . $price . ' through Stripe';
    }
}
