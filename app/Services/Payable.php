<?php

namespace App\Services;

interface Payable
{
    /**
     * @param $total
     * @return mixed
     */
    public function process($total);

}
