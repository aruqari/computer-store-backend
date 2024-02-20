<?php

use App\Http\Controllers\KatalogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\ApiAuthMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/users', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);
Route::get('/products', [KatalogController::class, 'indexMobile'])->name("ProductListMobile");
Route::get('/products/{id_katalog}', [KatalogController::class, 'show'])->name("ProductListMobile");


Route::middleware(ApiAuthMiddleware::class)->group(function () {
	Route::get('/users/current', [UserController::class, 'get']);
	Route::get('/users/pelanggan', [UserController::class, 'getPelanggan']);
	Route::delete('/users/logout', [UserController::class, 'logout']);
	Route::get('/cart', [CartController::class, 'get']);
	Route::delete('/cart', [CartController::class, 'delete']);
	Route::post('/cart/add', [CartController::class, 'add']);
	Route::post('/trans/add', [TransactionController::class, 'add']);
	Route::get('/trans', [TransactionController::class, 'get']);
	Route::post('/trans/byid', [TransactionController::class, 'getById']);
	Route::post('/trans/detail', [TransactionController::class, 'getDetail']);
});
