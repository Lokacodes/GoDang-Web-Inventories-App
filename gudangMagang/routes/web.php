<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/test', function () { 
//     return view('Receive.receive');
// });

//login
Route::get('/login',[\App\Http\Controllers\LoginController::class, 'index']);
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'auth']);
Route::post('/registrasi', [\App\Http\Controllers\LoginController::class, 'registrasi']);
//Home


//Barang

Route::post('/barang/update/{kode_barang}', [\App\Http\Controllers\BarangController::class, 'update']);
Route::post('/barang/store', [\App\Http\Controllers\BarangController::class, 'store']);

//Kategori

Route::post('/kategori/store', [\App\Http\Controllers\KategoriController::class, 'store']);

//Brand

Route::post('/brand/store', [\App\Http\Controllers\BrandController::class, 'store']);

//Receiving
Route::get('/receiving', [\App\Http\Controllers\ReceivingController::class, 'index']);

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);

    //view barang
    Route::get('/barang', [\App\Http\Controllers\BarangController::class, 'index']);
    Route::get('/barang/{kode_barang}', [\App\Http\Controllers\BarangController::class, 'show']);
    Route::get('/barang/edit/{kode_barang}', [\App\Http\Controllers\BarangController::class, 'form']);

    //view kategori
    Route::get('/kategori', [\App\Http\Controllers\KategoriController::class, 'index']);

    //view brand
    Route::get('/brand', [\App\Http\Controllers\BrandController::class, 'index']);

    //Receiving
    Route::get('/receive', [\App\Http\Controllers\ReceivingController::class, 'index']);

    //Send
    Route::get('/sending', [\App\Http\Controllers\SendingController::class, 'index']);

    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout']);
});