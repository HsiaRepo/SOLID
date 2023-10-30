<?php

namespace App\Repositories;


use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ApiRepository extends Repository
{

    /**
     * @return Model
     */
    public function all(): Collection
    {
        $products = File::get(storage_path('products.json'));
        $products = json_decode($products, true);
        $products = Product::hydrate($products);
        return $products;
    }
}
