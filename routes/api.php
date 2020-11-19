<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreativeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VendorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [RegisterController::class, 'postLoginAction']);

Route::get('creatives', [CreativeController::class, 'cgetAction']);
Route::get('creatives/{id}', [CreativeController::class, 'getAction']);
Route::post('creatives', [CreativeController::class, 'postAction']);
Route::patch('creatives/{id}', [CreativeController::class, 'patchAction']);


Route::get('products/{creative_id}', [ProductController::class, 'cgetAction']);
Route::get('product/{id}', [ProductController::class, 'getAction']);

Route::get('orders/{user_id}', [OrderController::class, 'cgetAction']);
Route::get('order/{id}', [OrderController::class, 'getAction']);
Route::post('orders', [OrderController::class, 'postAction']);


Route::get('vendors/{vendor_id}', [VendorController::class, 'cgetAction']);