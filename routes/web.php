<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransaksiUserController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminLaporanController;

// ================= PUBLIC =================
Route::get('/', [WelcomeController::class, 'index']);

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/search', [ProdukController::class, 'search'])->name('produk.search');

Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);

Route::get('/contact', function () {
    return view('contact');
});

// ================= USER LOGIN REQUIRED =================
Route::middleware(['auth'])->group(function () {

    // CART
    Route::post('/cart/tambah/{id}', [KeranjangController::class, 'add'])
        ->name('keranjang.tambah');
    Route::get('/cart', [KeranjangController::class, 'index'])
        ->name('keranjang.index');
    Route::get('/cart/remove/{id}', [KeranjangController::class, 'remove'])
        ->name('keranjang.remove');
    Route::post('/cart/update/{id}', [KeranjangController::class, 'update'])
        ->name('keranjang.update');

    // CHECKOUT dari keranjang
    Route::post('/checkout', [CheckoutController::class, 'proses'])
        ->name('checkout.proses');

    // BELI SEKARANG — langsung checkout 1 produk
    Route::post('/checkout/beli-sekarang/{id}', [CheckoutController::class, 'beliSekarang'])
        ->name('checkout.beli.sekarang');

    // RIWAYAT TRANSAKSI
    Route::get('/transaksi/riwayat', [TransaksiUserController::class, 'riwayat'])
        ->name('transaksi.riwayat');
    Route::get('/transaksi/{id}', [TransaksiUserController::class, 'detail'])
        ->name('transaksi.detail');

});

// ================= ADMIN =================
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // Produk
    Route::resource('/produk', ProdukController::class)
        ->names('admin.produk');

    // User
    Route::resource('/user', AdminUserController::class)
        ->names('admin.user')
        ->parameters(['user' => 'id']);

    // Transaksi
    Route::get('/transaksi', [AdminTransaksiController::class, 'index'])
        ->name('admin.transaksi.index');
    Route::get('/transaksi/{id}', [AdminTransaksiController::class, 'show'])
        ->name('admin.transaksi.show');
    Route::patch('/transaksi/{id}/status', [AdminTransaksiController::class, 'updateStatus'])
        ->name('admin.transaksi.updateStatus');

    Route::get('/laporan', [AdminLaporanController::class, 'index'])
        ->name('admin.laporan.index');
});