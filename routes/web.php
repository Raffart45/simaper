<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\User\Dashboard\DashboardController as DashboardUserController;
use App\Http\Controllers\User\Dashboard\PesananController as PesananUserController;
use App\Http\Controllers\User\Dashboard\TransaksiController as TransaksiUserController;
use App\Http\Controllers\User\Dashboard\UserProfileController;
use App\Http\Controllers\User\Dashboard\ReturnProdukController;
use App\Http\Controllers\User\Web\ViewController;
use App\Http\Controllers\User\Web\RegisterController;
use App\Http\Controllers\User\Web\LoginController as LoginUserController;
use App\Http\Controllers\User\Web\PembayaranController;
use App\Http\Controllers\Api\OngkirController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [ViewController::class,'index'])->name('user');
Route::get('detail/{id}', [ViewController::class,'detail'])->name('user.detail');
Route::get('checkout', [ViewController::class,'checkout'])->name('user.checkout');
Route::post('checkout/process', [ViewController::class,'submitOrder'])->name('user.order');
Route::get('checkout/success', [ViewController::class, 'orderSuccess'])->name('success');


Route::get('contact', [ViewController::class,'contact'])->name('user.contact');
Route::get('pembayaran/{id}', [PembayaranController::class,'bayarDP'])->name('user.pembayaran');
Route::post('pembayaran/{id}/store', [PembayaranController::class,'store'])->name('user.pembayaran.store');

Route::get('pembayaran_lunas/{id}', [PembayaranController::class,'bayarLunas'])->name('user.pembayaran.lunas');
Route::post('pembayaran_lunas/{id}/store', [PembayaranController::class,'storeLunas'])->name('user.pembayaran.lunas.store');
Route::get('payment/success', [ViewController::class, 'paymentSuccess'])->name('user.success.payment');
// routes/api.php
Route::get('/ongkir', [OngkirController::class, 'getOngkir']);
Route::post('/ongkir/fetch', [OngkirController::class, 'fetch'])->name('ongkir.fetch');


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginUserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginUserController::class, 'login']);

// ROute dashboard admin
Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'authenticate'])->name('admin.login.auth');

Route::group(['prefix' => 'admin', 'middleware' => ['admin.auth']], function () {
    Route::get('dashboard', [DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    // Menangani upload file secara terpisah

    Route::resource('produk', ProdukController::class)->except(['show']);
    Route::get('produk/cetak', [ProdukController::class, 'cetakData'])->name('produk.cetak');
    Route::resource('pesanan', PesananController::class)->except(['show']);
    Route::get('pesanan/print', [PesananController::class, 'printPesanan'])->name('pesanan.print');
    Route::resource('inventory', InventoryController::class)->except(['show']);
    Route::get('/laporan/rekap-bulanan-pesanan', [PesananController::class, 'rekapBulanan'])->name('laporan.rekapBulanan');
    Route::get('/laporan/print-rekap-pesanan', [PesananController::class, 'printRekap'])->name('laporan.printRekap');
    Route::get('inventory/print', [InventoryController::class, 'printInventory'])->name('inventory.print');
    Route::resource('bayar', TransaksiController::class);
    Route::get('transaksi_bayar/print', [TransaksiController::class, 'printTransaksi'])->name('transaksi.print');
    Route::get('/laporan/rekap-bulanan-transaksi', [TransaksiController::class, 'rekapBulananTransaksi'])->name('laporan.rekapBulananTransaksi');
    Route::get('/laporan/print-rekap-transaksi', [TransaksiController::class, 'printRekapTransaksi'])->name('laporan.printRekapTransaksi');
    Route::get('data/ongkir', [DashboardController::class, 'showOngkir'])->name('admin.ongkir.data');
    Route::get('data/return', [DashboardController::class, 'showReturnProduk'])->name('admin.return.data');
    Route::get('data/return/{id}/edit-status', [DashboardController::class, 'editStatus'])->name('admin.return.edit-status');
    Route::post('data/return/{id}/update-status', [DashboardController::class, 'updateStatus'])->name('admin.return.update-status');
    Route::get('data/return/print', [DashboardController::class, 'printReturnProduk'])->name('return.print');
});

// Route dashboard user
Route::group(['prefix' => 'pelanggan', 'middleware' => ['auth']], function () {
    Route::get('logout', [LoginUserController::class, 'logout'])->name('logout');
    Route::get('pelanggan',[DashboardUserController::class,'index'])->name('dashboard.user');
    Route::get('pelanggan/pesanan',[PesananUserController::class,'index'])->name('dashboard.user.pesanan');
    Route::get('transaksi', [TransaksiUserController::class,'index'])->name('dashboard.user.transaksi');
    Route::get('invoice/{id}', [TransaksiUserController::class, 'generateInvoice'])->name('user.invoice');
    Route::get('profile', [UserProfileController::class, 'show'])->name('user.profile.show');
    Route::get('profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('profile', [UserProfileController::class, 'update'])->name('user.profile.update');
    Route::get('return', [ReturnProdukController::class, 'index'])->name('user.return');
    Route::get('return/{id}/form', [ReturnProdukController::class, 'form'])->name('user.return.form');
    Route::post('return/store', [ReturnProdukController::class, 'store'])->name('user.return.store');
});
