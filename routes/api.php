<?php

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;

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

Route::get('/admins', [AdminController::class, 'index']);
Route::post('/admins', [AdminController::class, 'store']);
Route::put('/admins/{admin}', [AdminController::class, 'updated']);
Route::delete('/admins/{admin}', [AdminController::class, 'destroy']);


Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{customer}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{customer}', [CustomerController::class, 'updated']);
Route::delete('/customers', [CustomerController::class, 'destroy']);


Route::get('/products', [CustomerController::class, 'index']);
Route::get('/products/{product}', [CustomerController::class, 'show']);
Route::post('/products', [CustomerController::class, 'store']);
Route::put('/products/{product}', [CustomerController::class, 'updated']);
Route::delete('/products/{$product}', [CustomerController::class, 'destroy']);

