<?php

namespace App\Http\Controllers;

use App\Repositories\ApiRepository;
use App\Repositories\DatabaseRepository;
use App\Repositories\Repository;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Response;
use Spatie\FlareClient\Api;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ApiRepository $repository
     * @return Response
     */
    public function index(ApiRepository $repository)
    {
        $products = $repository->all();
        return view('welcome', compact('products'));
    }

}
