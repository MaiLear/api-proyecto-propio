<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/cart/store',[CustomerController::class,'cart']);

Route::get('/products/status/{idProduct}', [ProductController::class, 'inactive']);

Route::get('/products/active/{idProduct}', [ProductController::class, 'active']);

Route::resource('admins', AdminController::class);

Route::resource('customers', CustomerController::class);


Route::resource('products', ProductController::class);


