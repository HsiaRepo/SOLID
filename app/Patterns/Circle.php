<?php

namespace App\Patterns;

// circle
// pi * radius ^ 2
class Circle implements Shapable
{
    protected $radius;

    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    public function area()
    {
        return $this->radius * $this->radius * pi();
    }
}
