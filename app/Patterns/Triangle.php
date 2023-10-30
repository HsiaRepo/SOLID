<?php

namespace App\Patterns;

// triangle
// (width * height) /2
class Triangle implements Shapable
{
    public $height;
    public $base;

    public function __construct($height, $base)
    {
        $this->height = $height;
        $this->base = $base;
    }

    public function area()
    {
        return $this->height * $this->base / 2;
    }
}
