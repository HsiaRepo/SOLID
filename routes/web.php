<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessOrdersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('area', function(\App\Patterns\AreaCalculator $areaCalculator) {

    $square = new \App\Patterns\Square(10,10);
    $triangle = new \App\Patterns\Triangle(10,6);
    $circle = new \App\Patterns\Circle(10);

    return $areaCalculator->calculate($circle);

});

Route::post('order/{product_id}/process', [ProcessOrdersController::class, '__invoke']);

