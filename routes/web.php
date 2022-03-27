<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisProdukController;
use App\Http\Controllers\JenisUsahaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
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
    Route::get('/beranda', [DashboardController::class, 'index'])->name('beranda');
    Route::post('beranda-filter', [DashboardController::class, 'filter'])->name('beranda.filter');
    Route::resource('akun', AkunController::class);

    Route::middleware(['admin'])->group(function () {
        Route::get('/penjualan-sudah-bayar', [PenjualanController::class, 'penjualan_sudah_bayar'])->name('penjualan.sudah_bayar');
        Route::get('/penjualan-sudah-bayar/data', [PenjualanController::class, 'penjualan_sudah_bayar_data'])->name('penjualan.sudah_bayar.data');

        Route::get('/penjualan-belum-bayar', [PenjualanController::class, 'penjualan_belum_bayar'])->name('penjualan.belum_bayar');
        Route::get('/penjualan-belum-bayar/data', [PenjualanController::class, 'penjualan_belum_bayar_data'])->name('penjualan.belum_bayar.data');


        Route::get('invoice/', [ReportController::class, 'invoice'])->name('report.invoice');
        Route::post('invoice/data', [ReportController::class, 'invoice_data'])->name('report.invoice.data');
        Route::get('invoice/pdf/{id}/{tahun}/{bulan}', [ReportController::class, 'invoice_pdf'])->name('report.invoice.pdf');

        Route::get('kuitansi/', [ReportController::class, 'kuitansi'])->name('report.kuitansi');
        Route::post('kuitansi/data', [ReportController::class, 'kuitansi_data'])->name('report.kuitansi.data');
        Route::get('kuitansi/pdf/{id}/{tahun}/{bulan}/{tanggal}', [ReportController::class, 'kuitansi_pdf'])->name('report.kuitansi.pdf');

        Route::get('/produk/data', [ProductController::class, 'data'])->name('produk.data');
        Route::resource('produk', ProductController::class);
    
        Route::get('/rekanan-usaha/data', [PlaceController::class, 'data'])->name('rekanan-usaha.data');
        Route::resource('rekanan-usaha', PlaceController::class);
    
        Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
        Route::resource('user', UserController::class);

        Route::get('/jenis-produk/data', [JenisProdukController::class, 'data'])->name('jenis-produk.data');
        Route::resource('jenis-produk', JenisProdukController::class);

        Route::get('/jenis-usaha/data', [JenisUsahaController::class, 'data'])->name('jenis-usaha.data');
        Route::resource('jenis-usaha', JenisUsahaController::class);

        Route::get('/pengaturan', [SettingController::class, 'index'])->name('pengaturan');
        Route::post('/pengaturan/store', [SettingController::class, 'store'])->name('pengaturan.store');
    });

    Route::middleware(['user2'])->group(function () {
        Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
        Route::post('/penjualan/change-status/{id}', [PenjualanController::class, 'change_status'])->name('penjualan.change-status');
        Route::post('/penjualan/change-status-all', [PenjualanController::class, 'change_status_all'])->name('penjualan.change-status-all');
        Route::resource('penjualan', PenjualanController::class);

        Route::get('/struk-penjualan/{id}', [PenjualanController::class, 'struk'])->name('penjualan.struk');
    });

    Route::middleware(['user1'])->group(function () {
      

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
