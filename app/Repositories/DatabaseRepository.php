<?php

namespace App\Repositories;


use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class DatabaseRepository extends Repository
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Product::all();
    }
}
