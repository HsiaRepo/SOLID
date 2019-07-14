<?php

namespace App\Services;


/**
 * Interface Orderable
 *
 * @package App\Services
 */
interface Orderable
{
    /**
     * @return mixed
     */
    public function calculate();

    /**
     * @param int $shipping
     * @return mixed
     */
    public function shipping(int $shipping);

    /**
     * @param $discount
     * @return mixed
     */
    public function discount($discount);

    /**
     * @param $company
     * @return mixed
     */
    public function delivery($company);

    /**
     * @return mixed
     */
    public function process();

}
