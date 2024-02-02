<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('product',ProductController::class);
Route::resource('user',RoleController::class);
Route::resource('transaction', TransactionController::class);
Route::resource('wallet',WalletController::class);
Route::post('/addtocart',[TransactionController::class, 'addtocart'])->name('addtocart');
Route::post('/transaksi',[WalletController::class, 'transaksi'])->name('transaksi');
Route::put('/paynow',[TransactionController::class, 'paynow'])->name('paynow');
Route::put('/acceptsaldo/{wallet}',[WalletController::class, 'acceptsaldo'])->name('acceptsaldo');
Route::put('/reject/{wallet}',[WalletController::class, 'reject'])->name('reject');
Route::put('/accept/{transaction}',[TransactionController::class, 'accept'])->name('accept');
Route::get('/riwayat', [HomeController::class,'riwayat'])->name('riwayat');
Route::get('/transaksi-harian/{date}', [HomeController::class,'transaksiharian'])->name('transaksiharian');
Route::get('/transaksi-order/{order_id}', [HomeController::class,'transaksiorder'])->name('transaksiorder');
