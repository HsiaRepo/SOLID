<?php

namespace App\Services;


class OrderManager implements Orderable
{
    protected $items;

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    /**
     * @return mixed
     */
    public function shipping()
    {
        return 5;
    }

    /**
     * @param $discount
     * @return mixed
     */
    public function discount($discount = 0.02)
    {
        return $this->total() * $discount;
    }

    /**
     * @param $company
     * @return mixed
     */
    public function delivery($company)
    {
        return 'Delivery will be made by ' . $company;
    }

    /**
     * @return mixed
     */
    public function total()
    {
        return collect($this->items)->sum('price');
    }

    public function workout($company)
    {
        $totalToPay = ($this->pay() + $this->shipping()) - $this->discount();
        return (object)[
            'delivery' => $this->delivery($company),
            'total' => $totalToPay
        ];
    }
}
