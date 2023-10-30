<?php

namespace App\Http\Controllers;

use App\Repositories\DatabaseRepository;

class ProductsController
{

    public function index(DatabaseRepository $repository)
    {

        $products = $repository->all();

        return view('welcome', compact('products'));
    }

}
