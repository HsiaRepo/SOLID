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
     * @param $discount
     * @return mixed
     */
    public function discount($discount);

    /**
     * @return mixed
     */
    public function process();

}
