<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Repositories\ApiRepository;
use App\Repositories\DatabaseRepository;
use Spatie\FlareClient\Api;
use Symfony\Component\VarDumper\Cloner\Data;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_browse_all_products(): void
    {
//          Uncomment for DatabaseRepository
        $products = Product::factory(31)->create();

//          Uncomment for ApiRepository
//        $products = app(ApiRepository::class)->all();

        $response = $this->get('/')->assertOk();

        $data = $response->viewData('products');

        $this->assertSame($products->count(), $data->count());
        $this->assertInstanceOf(Product::class, $data->first());

    }
}
