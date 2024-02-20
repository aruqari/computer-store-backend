<?php

use App\Http\Controllers\DetailServiceController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\WebAuthMiddleware;
use App\Http\Middleware\WebGuestMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function (Request $request) {
//     return view('welcome', [
//         "title" => $request->input("title")
//     ]);
// });
Route::middleware(WebAuthMiddleware::class)->group(function () {
    Route::get('/logout', [UserController::class, 'logoutAdmin']);
    Route::get('/home', function (Request $request) {
        return view('home');
    })->name("Admin");

    Route::get('/services', [DetailServiceController::class, 'index'])->name("ServicesList");

    Route::get('/transaksi', [TransactionController::class, 'index'])->name("TransList");
    Route::get('/transaksi/{id_pembelian}', [TransactionController::class, 'show'])->name("TransDetail");
    Route::post('/transaksi/ubahStatus', [TransactionController::class, 'status'])->name("TransStatus");

    Route::get('/products', [KatalogController::class, 'index'])->name("ProductList");
    Route::get('/products/add', [KatalogController::class, 'create'])->name("CreateProduct");
    Route::get('/products/edit/{id_katalog}', [KatalogController::class, 'edit'])->name("EditProduct");


    Route::patch('/updateProduct', [KatalogController::class, 'update'])->name("UpdateProduct");
    Route::post('/storeProduct', [KatalogController::class, 'store'])->name("StoreProduct");
    Route::delete('/destroyProduct', [KatalogController::class, 'destroy'])->name("DestroyProduct");

});

Route::middleware(WebGuestMiddleware::class)->group(function () {
    Route::get('/', function (Request $request) {
        return view('login');
    })->name("loginAdmin");
    Route::post('/login', [UserController::class, 'loginAdmin']);
});

