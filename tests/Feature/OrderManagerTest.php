<?php

namespace Tests\Feature;

use App\Services\BaseOrderManager;
use App\Services\HardCopiesOrderManager;
use App\Services\SoftCopiesOrderManager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderManagerTest extends TestCase
{
    /** @test */
    public function that_hard_copy_order_manager_can_workout_an_order(): void
    {
        $items = [
            ['title' => 'test-book-1', 'price' => 2],
            ['title' => 'test-book-2', 'price' => 4],
            ['title' => 'test-book-3', 'price' => 6],
        ];
        $deliveryCompany = 'Fedex';

        $orderManager = new HardCopiesOrderManager($items);
        $deliveryMessage = 'Delivery will be made by ' . $deliveryCompany;

        $processedOrder = $orderManager
            ->calculate()
            ->discount()
            ->shipping(5)
            ->delivery($deliveryCompany)
            ->process();

        $this->assertSame(16.759999999999998, $processedOrder->paid);   // TODO rounding error
        $this->assertSame($deliveryMessage, $processedOrder->delivery);
    }

    /** @test */
    public function that_soft_copy_order_manager_can_workout_an_order(): void
    {
        $items = [
            ['title' => 'test-book-1', 'price' => 2],
            ['title' => 'test-book-2', 'price' => 4],
            ['title' => 'test-book-3', 'price' => 6],
        ];

        $orderManager = new SoftCopiesOrderManager($items);
        $deliveryMessage = 'download link';

        $processedOrder = $orderManager
            ->calculate()
            ->discount()
            ->process();

        $this->assertSame(11.76, $processedOrder->paid);   // TODO rounding error
        $this->assertSame($deliveryMessage, $processedOrder->delivery);
    }
}
