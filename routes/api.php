<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PreSaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ValidateToken;

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

Route::post('/cart/store', [CustomerController::class, 'cart']);

Route::get('/products/status/{idProduct}', [ProductController::class, 'inactive']);

Route::get('/products/active/{idProduct}', [ProductController::class, 'active']);

Route::get('/{quantity}/products', [ProductController::class, 'getProducts']);
Route::get('/{quantity}/newproducts', [ProductController::class, 'getNewProducts']);

Route::get('/filterproducts', [ProductController::class, 'getFilterProducts']);
Route::get('/allproducts', [ProductController::class, 'getAllProducts']);

Route::post('/presales/store', [PreSaleController::class, 'store'])->middleware('token');

Route::get('/filtercustomers', [CustomerController::class, 'getFilterCustomers']);
Route::post('/customers/authenticate', [CustomerController::class, 'authenticate']);
Route::post('/customers/logout', [CustomerController::class, 'logout']);

Route::post('/admins/store', [AdminController::class, 'store']);
Route::post('/admins/authenticate', [AdminController::class, 'authenticate']);

Route::get('/admins/logout', [AdminController::class, 'logout']);

Route::get('/token/validate', [ValidateToken::class, 'validate']);

Route::apiResource('admins', AdminController::class)->except(['store']);

Route::apiResource('customers', CustomerController::class);


Route::apiResource('products', ProductController::class)->except(['index']);
