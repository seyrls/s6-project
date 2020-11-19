<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreativeController;
use App\Http\Controllers\Auth\RegisterController;

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

//\Illuminate\Support\Facades\Broadcast::routes(['middleware' => ['auth:sanctum']]);


Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [RegisterController::class, 'postLoginAction']);
//Route::middleware(['auth:sanctum'])->group(function () {
//    Route::get('/users', [RegisterController::class, 'postLoginAction']);
//});

Route::get('creatives', [CreativeController::class, 'cgetAction']);
Route::get('creatives/{id}', [CreativeController::class, 'getAction']);
Route::post('creatives', [CreativeController::class, 'postAction']);
