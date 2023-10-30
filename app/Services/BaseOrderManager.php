<?php

namespace App\Services;


class BaseOrderManager implements Orderable
{
    protected $total;
    /**
     * @var array
     */
    protected $items;

    /** @var string */
    protected $deliveryMessage;

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function calculate()
    {
        $this->total = collect($this->items)->sum('price');
        return $this;
    }

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
     * @param $discount
     * @return mixed
     */
    public function discount($discount = 0.02)
    {
        $this->total -= $this->total * $discount;
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
