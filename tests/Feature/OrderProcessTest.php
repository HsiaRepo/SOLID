<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderProcessTest extends TestCase
{
    use RefreshDatabase;

     public function a_user_order_can_be_processed():void
     {
         $product = ProductFactory::new();

         // TODO WIP



     }
}
