<?php

namespace App\Patterns;


class AreaCalculator
{
    public function calculate(Shapable $shapable)
    {
        return $shapable->area();
    }

}
