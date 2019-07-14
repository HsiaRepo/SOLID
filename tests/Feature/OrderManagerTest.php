<?php

namespace Tests\Feature;

use App\Services\OrderManager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderManagerTest extends TestCase
{
    /** @test */
    public function order_manager_can_workout_an_order(): void
    {
        $items = [
            ['title' => 'test-book-1', 'price' => 2],
            ['title' => 'test-book-2', 'price' => 4],
            ['title' => 'test-book-3', 'price' => 6],
        ];
        $deliveryCompany = 'Fedex';

        $orderManager = new OrderManager($items);
        $deliveryMessage = 'Delivery will be made by '. $deliveryCompany;

        $processedOrder = $orderManager
                                    ->calculate()
                                    ->discount()
                                    ->shipping(5)
                                    ->delivery($deliveryCompany)
                                    ->process();



        $this->assertSame(16.76, $processedOrder->paid);
        $this->assertSame($deliveryMessage, $processedOrder->delivery);
    }
}