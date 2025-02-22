<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PakaianController;
use App\Http\Controllers\ranselController;
use App\Http\Controllers\SepatuController;
use App\Http\Controllers\tendaController;
use App\Models\Ransel;
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

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

// TANPA LOGIN
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/client', [HomeController::class, 'client'])->name('client');
Route::get('/booking', [HomeController::class, 'booking'])->name('booking');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// AKSES USER BIASA
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/product/{category}/{id}', [HomeController::class, 'single'])->name('single');

    // BOOKING
    Route::post('/booking/{category}/{id}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::put('/bookings/cancel/{id}', [BookingController::class, 'cancelBooking'])->name('bookings.cancel');
    Route::put('/bookings/return/{category}/{id}', [BookingController::class, 'confirmReturn'])->name('bookings.return');
    Route::get('/bookings/{category}/{id}', [BookingController::class, 'show'])->name('bookings.show');

    // CONTACT
    Route::post('/contact', [HomeController::class, 'contactStore'])->name('contact/store');
});

// AKSES ADMIN
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin/dashboard');

    // CUSTOMER
    Route::get('/admin/customer', [CustomerController::class, 'index'])->name('admin/customer');
    Route::get('/admin/customer/edit/{id}', [CustomerController::class, 'edit'])->name('admin/customer/edit');
    Route::put('/admin/customer/edit/{id}', [CustomerController::class, 'update'])->name('admin/customer/update');
    Route::delete('/admin/customer/destroy/{id}', [CustomerController::class, 'destroy'])->name('admin/customer/destroy');

    // LAPORAN
    Route::get('/admin/riwayat-transaksi', [AdminController::class, 'showBookingHistory'])->name('admin/riwayat-transaksi');
    Route::get('admin/top-pelanggan', [AdminController::class, 'topCustomersReport'])->name('admin/top-pelanggan');
    Route::get('admin/keuangan', [AdminController::class, 'financialReport'])->name('admin/keuangan');
    Route::get('admin/top-transaksi', [AdminController::class, 'topTransactionsReport'])->name('admin/top-transaksi');

    // CONTACT
    Route::get('/admin/testimoni', [ContactController::class, 'index'])->name('admin/testimoni');
    Route::get('/admin/pesan', [ContactController::class, 'indexPesan'])->name('admin/pesan');
    Route::get('/admin/testimoni/create', [ContactController::class, 'create'])->name('admin/testimoni/create');
    Route::post('/admin/testimoni/store', [ContactController::class, 'store'])->name('admin/testimoni/store');
    Route::get('/admin/testimoni/edit/{id}', [ContactController::class, 'edit'])->name('admin/testimoni/edit');
    Route::put('/admin/testimoni/edit/{id}', [ContactController::class, 'update'])->name('admin/testimoni/update');
    Route::delete('/admin/testimoni/destroy/{id}', [ContactController::class, 'destroy'])->name('admin/testimoni/destroy');
    Route::delete('/admin/pesan/destroy/{id}', [ContactController::class, 'destroyPesan'])->name('admin/pesan/destroy');

    // RANSEL
    Route::get('/admin/ransel', [ranselController::class, 'index'])->name('admin/ransel');
    Route::get('/admin/ransel/create', [ranselController::class, 'create'])->name('admin/ransel/create');
    Route::post('/admin/ransel/store', [ranselController::class, 'store'])->name('admin/ransel/store');
    Route::get('/admin/ransel/edit/{id}', [ranselController::class, 'edit'])->name('admin/ransel/edit');
    Route::put('/admin/ransel/edit/{id}', [ranselController::class, 'update'])->name('admin/ransel/update');
    Route::delete('/admin/ransel/destroy/{id}', [ranselController::class, 'destroy'])->name('admin/ransel/destroy');

    // PAKAIAN
    Route::get('/admin/pakaian', [PakaianController::class, 'index'])->name('admin/pakaian');
    Route::get('/admin/pakaian/create', [PakaianController::class, 'create'])->name('admin/pakaian/create');
    Route::post('/admin/pakaian/store', [PakaianController::class, 'store'])->name('admin/pakaian/store');
    Route::get('/admin/pakaian/edit/{id}', [PakaianController::class, 'edit'])->name('admin/pakaian/edit');
    Route::put('/admin/pakaian/edit/{id}', [PakaianController::class, 'update'])->name('admin/pakaian/update');
    Route::delete('/admin/pakaian/destroy/{id}', [PakaianController::class, 'destroy'])->name('admin/pakaian/destroy');

    // SEPATU
    Route::get('/admin/sepatu', [SepatuController::class, 'index'])->name('admin/sepatu');
    Route::get('/admin/sepatu/create', [SepatuController::class, 'create'])->name('admin/sepatu/create');
    Route::post('/admin/sepatu/store', [SepatuController::class, 'store'])->name('admin/sepatu/store');
    Route::get('/admin/sepatu/edit/{id}', [SepatuController::class, 'edit'])->name('admin/sepatu/edit');
    Route::put('/admin/sepatu/edit/{id}', [SepatuController::class, 'update'])->name('admin/sepatu/update');
    Route::delete('/admin/sepatu/destroy/{id}', [SepatuController::class, 'destroy'])->name('admin/sepatu/destroy');

    // TENDA
    Route::get('/admin/tenda', [tendaController::class, 'index'])->name('admin/tenda');
    Route::get('/admin/tenda/create', [tendaController::class, 'create'])->name('admin/tenda/create');
    Route::post('/admin/tenda/store', [tendaController::class, 'store'])->name('admin/tenda/store');
    Route::get('/admin/tenda/edit/{id}', [tendaController::class, 'edit'])->name('admin/tenda/edit');
    Route::put('/admin/tenda/edit/{id}', [tendaController::class, 'update'])->name('admin/tenda/update');
    Route::delete('/admin/tenda/destroy/{id}', [tendaController::class, 'destroy'])->name('admin/tenda/destroy');
});
