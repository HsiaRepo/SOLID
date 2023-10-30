<?php

namespace App\Services;


abstract class BaseOrderManager implements Orderable
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
     * @param $discount
     * @return mixed
     */
    public function discount($discount = 0.02)
    {
        $this->total -= $this->total * $discount;
        return $this;
    }

    abstract public function process();

}
