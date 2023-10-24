<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Stock;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderProcessTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
     public function a_user_order_can_be_processed():void
     {
         $product = Product::factory()->create();
         $stock = Stock::factory()->create([
             'product_id' => $product->id
         ]);

         $response = $this->post("/order/{$product->id}/process", [
            'payment_method' => 'stripe'
         ])->assertOk();

     }
}
