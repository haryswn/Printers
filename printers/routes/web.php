<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginCon;
use App\Http\Controllers\DashboardCon;
use App\Http\Controllers\RegisterCon;
use App\Http\Controllers\UserCon;
use App\Http\Controllers\ProdukCon;
use App\Http\Controllers\TransaksiCon;

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

Route::get('/', [produkCon::class, 'home'])->name('homeproduk');

Route::get('/login', [LoginCon::class, 'login'])->name('login');
Route::post('actionlogin', [LoginCon::class, 'actionlogin'])->name('actionlogin');
Route::get('dashboard', [DashboardCon::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('actionlogout', [LoginCon::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
Route::get('register', [RegisterCon::class, 'register'])->name('register');
Route::post('register/action', [RegisterCon::class, 'actionregister'])->name('actionregister');

Route::get('/user/tampil', [UserCon::class, 'index'])->name('indexUser')->middleware('auth');
Route::get('/user/input', [UserCon::class, 'input'])->name('inputUser')->middleware('auth');
Route::post('/user/storeinput', [UserCon::class, 'storeinput'])->name('storeInputUser')->middleware('auth');
Route::get('/user/update/{id}', [UserCon::class, 'update'])->name('updateUser')->middleware('auth');
Route::post('/user/storeupdate', [UserCon::class, 'storeupdate'])->name('storeUpdateUser')->middleware('auth');
Route::get('/user/delete/{id}', [UserCon::class, 'delete'])->name('deleteUser')->middleware('auth');

Route::get('/produk/tampil', [produkCon::class, 'index'])->name('indexproduk')->middleware('auth');
Route::get('/produk/input', [produkCon::class, 'input'])->name('inputproduk')->middleware('auth');
Route::post('/produk/storeinput', [produkCon::class, 'storeinput'])->name('storeInputproduk')->middleware('auth');
Route::get('/produk/update/{id}', [produkCon::class, 'update'])->name('updateproduk')->middleware('auth');
Route::post('/produk/storeupdate', [produkCon::class, 'storeupdate'])->name('storeUpdateproduk')->middleware('auth');
Route::get('/produk/delete/{id}', [produkCon::class, 'delete'])->name('deleteproduk')->middleware('auth');
Route::get('/produk/upload', [produkCon::class, 'upload'])->name('upload')->middleware('auth');
Route::post('/produk/uploadproses', [produkCon::class, 'uploadproses'])->name('uploadproses')->middleware('auth');

Route::get('/transaksi/tampil', [transaksiCon::class, 'index'])->name('indextransaksi')->middleware('auth');
Route::get('/transaksi/input', [transaksiCon::class, 'input'])->name('inputtransaksi')->middleware('auth');
Route::post('/transaksi/storeinput', [transaksiCon::class, 'storeinput'])->name('storeInputtransaksi')->middleware('auth');
Route::get('/transaksi/update/{id}', [transaksiCon::class, 'update'])->name('updatetransaksi')->middleware('auth');
Route::post('/transaksi/storeupdate', [transaksiCon::class, 'storeupdate'])->name('storeUpdatetransaksi')->middleware('auth');
Route::get('/transaksi/delete/{id}', [transaksiCon::class, 'delete'])->name('deletetransaksi')->middleware('auth');