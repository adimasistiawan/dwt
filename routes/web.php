<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('login-submit', [LoginController::class, 'login'])->name('login.submit');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('dashboard-filter', [DashboardController::class, 'filter'])->name('dashboard.filter');
    Route::resource('akun', AkunController::class);

    Route::middleware(['admin'])->group(function () {
        Route::get('/produk/data', [ProductController::class, 'data'])->name('produk.data');
        Route::resource('produk', ProductController::class);
    
        Route::get('/tempat-wisata/data', [PlaceController::class, 'data'])->name('tempat-wisata.data');
        Route::resource('tempat-wisata', PlaceController::class);
    
        Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
        Route::resource('user', UserController::class);
    });

    Route::middleware(['user2'])->group(function () {
        Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
        Route::post('/penjualan/change-status/{id}', [PenjualanController::class, 'change_status'])->name('penjualan.change-status');
        Route::post('/penjualan/change-status-all', [PenjualanController::class, 'change_status_all'])->name('penjualan.change-status-all');
        Route::resource('penjualan', PenjualanController::class);

        Route::get('/laporan/invoice/', [ReportController::class, 'invoice'])->name('report.invoice');
        Route::get('/laporan/invoice/data/{id}/{tahun}/{bulan}', [ReportController::class, 'invoice_data'])->name('report.invoice.data');
        Route::get('/laporan/invoice/pdf/{id}/{tahun}/{bulan}', [ReportController::class, 'invoice_pdf'])->name('report.invoice.pdf');
    });

    Route::middleware(['user1'])->group(function () {
        Route::get('/laporan/invoice/', [ReportController::class, 'invoice'])->name('report.invoice');
        Route::post('/laporan/invoice/data', [ReportController::class, 'invoice_data'])->name('report.invoice.data');
        Route::get('/laporan/invoice/pdf/{id}/{tahun}/{bulan}', [ReportController::class, 'invoice_pdf'])->name('report.invoice.pdf');

        Route::get('/laporan/perkiraan-pendapatan/', [ReportController::class, 'perkiraan_pendapatan'])->name('report.perkiraan_pendapatan');
        Route::post('/laporan/perkiraan-pendapatan/data', [ReportController::class, 'perkiraan_pendapatan_data'])->name('report.perkiraan_pendapatan.data');
        Route::get('/laporan/perkiraan-pendapatan/pdf/{id}/{dari}/{sampai}', [ReportController::class, 'perkiraan_pendapatan_pdf'])->name('report.perkiraan_pendapatan.pdf');

        Route::get('/laporan/rekapitulasi-pendapatan/', [ReportController::class, 'rekapitulasi_pendapatan'])->name('report.rekapitulasi_pendapatan');
        Route::post('/laporan/rekapitulasi-pendapatan/data', [ReportController::class, 'rekapitulasi_pendapatan_data'])->name('report.rekapitulasi_pendapatan.data');
        Route::get('/laporan/rekapitulasi-pendapatan/pdf/{id}/{dari}/{sampai}', [ReportController::class, 'rekapitulasi_pendapatan_pdf'])->name('report.rekapitulasi_pendapatan.pdf');

        Route::get('/laporan/produk/', [ReportController::class, 'produk'])->name('report.produk');
        Route::post('/laporan/produk/data', [ReportController::class, 'produk_data'])->name('report.produk.data');
        Route::get('/laporan/produk/pdf/{place_id}/{product_id}/{dari}/{sampai}', [ReportController::class, 'produk_pdf'])->name('report.produk.pdf');
        Route::get('/get-product/{id}', [ReportController::class, 'get_produk'])->name('report.get_produk');
    });
    
    Route::get('/logout', function() {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});
