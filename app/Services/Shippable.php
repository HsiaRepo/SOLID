<?php

namespace App\Services;


interface Shippable
{
    /**
     * @param $company
     * @return mixed
     */
    public function delivery($company);

    /**
     * @param int $shipping
     * @return mixed
     */
    public function shipping(int $shipping);
}
