<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);

Route::post('/logout', [UserController::class, 'logout']);

// Route group for all authenticated routes
//Route::group(['middleware' => ['auth:api']],function ()
//{
//
//});

Route::apiResource('products', ProductController::class, ['except' => ['store']]);

Route::post('/products/{supplier}', [ProductController::class, 'store']);

Route::apiResource('suppliers', SupplierController::class);

Route::apiResource('orders', OrderController::class, ['only' => ['index', 'show', 'destroy']]);
