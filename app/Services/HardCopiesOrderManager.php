<?php

namespace App\Services;


class HardCopiesOrderManager extends BaseOrderManager implements Shippable
{
    /**
     * @param int $shipping
     * @return mixed
     */
    public function shipping(int $shipping)
    {
        $this->total += $shipping;
        return $this;
    }

    /**
     * @param $company
     * @return mixed
     */
    public function delivery($company)
    {
        $this->deliveryMessage = 'Delivery will be made by ' . $company;
        return $this;
    }

    /**
     * @return object
     */
    public function process()
    {
        return (object)[
            'delivery' => $this->deliveryMessage,
            'paid' => $this->total
        ];
    }
}
