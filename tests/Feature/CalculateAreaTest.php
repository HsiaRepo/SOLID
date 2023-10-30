<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Patterns\Square;
use App\Patterns\Triangle;
use App\Patterns\Circle;
use App\Patterns\AreaCalculator;

class CalculateAreaTest extends TestCase
{
    /** @test */
    public function it_calculates_square_area_correctly(): void
    {
        $square = new Square(4, 5);
        $calculator = new AreaCalculator();

        $area = $calculator->calculate($square);
        $this->assertEquals(20, $area);
    }

    /** @test */
    public function it_calculates_triangle_area_correctly(): void
    {
        $triangle = new Triangle(3, 6);
        $calculator = new AreaCalculator();

        $area = $calculator->calculate($triangle);
        $this->assertEquals(9, $area);
    }

    /** @test */
    public function it_calculates_circle_area_correctly(): void
    {
        $circle = new Circle(3);
        $calculator = new AreaCalculator();

        $area = $calculator->calculate($circle);
        $this->assertEquals(9 * pi(), $area);
    }
}
