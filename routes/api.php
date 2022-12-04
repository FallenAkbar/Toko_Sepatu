<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TanggalController;
use App\Http\Controllers\CheckoutController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// register
Route::post('/register', [AuthController::class, 'register']);
//login
Route::post('/login', [AuthController::class, 'login']);
// manggil data produk sepatu
Route::get('/produk', [ProdukController::class, 'index']);
//manggil data alamat
Route::get('/alamat', [AlamatController::class, 'index']);
//manggil data tanggal
Route::get('/tanggal', [TanggalController::class, 'index']);
// add data tanggal user
Route::post('/Tanggal', [TanggalController::class, 'store']);
// add data Alamat user
Route::post('/Alamat', [AlamatController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    //checkout sepatu
    Route::resource('/checkout', CheckoutController::class);
    //logout
    Route::post('/logout', [AuthController::class, 'logout']);
    // hanya bisa digunakan oleh role Admin
    Route::middleware('admin')->group(function () {
        //manggil data produk
        Route::resource('/produk', ProdukController::class)->except('create', 'edit', 'show', 'index');
        //manggil data hanya 1 data dengan id
        Route::get('/produk/{id}', [ProdukController::class, 'show']);
        //manggil data alamat
        Route::resource('/alamat', AlamatController::class)->except('create', 'edit', 'show', 'index');
        //manggil data alamat hanya 1 dengan id
        Route::get('/alamat/{id}', [AlamatController::class, 'show']);
        //manggil data tanggal
        Route::resource('/tanggal', TanggalController::class)->except('create', 'edit', 'show', 'index');
        //manggil data tanggal hanya 1 dengan id
        Route::get('/tanggal/{id}', [TanggalController::class, 'show']);
    });
});
