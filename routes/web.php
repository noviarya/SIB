<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Route;
use App\http\Controllers\AuthController;
use App\http\Controllers\HomeController;
use App\http\Controllers\UserController;
use App\http\Controllers\KategoriController;
use App\http\Controllers\BarangController;
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

Route::get('/', [AuthController::class, 'index'])->name ('index');
Route::post('/cek_login', [AuthController::class, 'cek_login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth','checkLevel:admin']],function(){

    //Data Master (User)
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/{id}/update', [UserController::class, 'update']);
    Route::get('/user/{id}/destroy', [UserController::class, 'destroy']);

    //Data Master (Kategori)
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::post('/kategori/{id}/update', [KategoriController::class, 'update']);
    Route::get('/kategori/{id}/destroy', [KategoriController::class, 'destroy']);

    //Data Master (Barang)
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/store', [BarangController::class, 'store']);
    Route::post('/barang/{id}/update', [BarangController::class, 'update']);
    Route::get('/barang/{id}/destroy', [BarangController::class, 'destroy']);
});

Route::group(['middleware' => ['auth','checkLevel:admin,gudang']],function(){

    Route::get('/home', [AuthController::class, 'home']);
});