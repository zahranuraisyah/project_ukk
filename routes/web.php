<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KasirDashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\PembelianController;   
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminDashboardController;

//  Halaman Utama (Welcome)
Route::get('/', function () {
    return view('landing');
});


//  Register & Auth

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register.create');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

require __DIR__.'/auth.php'; // Load routes dari Laravel Breeze


// Middleware: Hanya Buat yang Sudah Login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Semua yang login bisa melihat daftar barang (akses dicek di controller)
    Route::get('/barangs', [BarangController::class, 'index'])->name('barangs.index');
});

// Middleware: Admin (Bisa CRUD Barang dan tambah stok)
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
  //  Route::get('/admin', function () {
    //    return view('admin.dashboard');
    //})->name('admin');
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // ✅ Admin bisa CRUD barang (cek akses di controller)
    Route::resource('barangs', BarangController::class)->except(['index']); // Kecuali 'index' karena udah ada

    //Route buat restock barang
    Route::get('/admin/pembelian', [PembelianController::class, 'index'])->name('admin.pembelian.index');
    Route::post('/admin/pembelian/store', [PembelianController::class, 'store'])->name('admin.pembelian.store');

    // Buat liat generate laporan
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/admin/laporan/generate', [LaporanController::class, 'generatePDF'])->name('admin.laporan.generate');
    Route::get('/admin/laporan', [LaporanController::class, 'previewLaporan'])->name('admin.laporan.preview');
    Route::get('/admin/laporan/download', [LaporanController::class, 'downloadLaporan'])->name('admin.laporan.download');

});

// Middleware: Kasir (Barang, Transaksi, Detail Transaksi)
Route::middleware(['auth', UserMiddleware::class])->group(function () {
    // ✅ Dashboard Kasir
    Route::get('/kasir', [KasirDashboardController::class, 'index'])->name('kasir.dashboard');

    // ✅ Menu untuk Kasir
    Route::get('/kasir/barangs', [BarangController::class, 'index'])->name('kasir.barangs');

    // ✅ Transaksi
    Route::get('/kasir/transaksi', [TransaksiController::class, 'index'])->name('kasir.transaksi.index');
    Route::get('/kasir/transaksi/create', [TransaksiController::class, 'create'])->name('kasir.transaksi.create');
    Route::post('/kasir/transaksi/store', [TransaksiController::class, 'store'])->name('kasir.transaksi.store');
    Route::post('/kasir/transaksi/tambahKeranjang', [TransaksiController::class, 'tambahKeranjang'])->name('kasir.transaksi.tambahKeranjang');
    //Route::post('/kasir/transaksi/proses', [TransaksiController::class, 'prosesTransaksi'])->name('kasir.transaksi.proses');
    Route::delete('/kasir/transaksi/reset', [TransaksiController::class, 'resetKeranjang'])->name('kasir.transaksi.reset');
    Route::post('/kasir/transaksi/prosesTransaksi', [TransaksiController::class, 'prosesTransaksi'])->name('kasir.transaksi.prosesTransaksi');

    // ✅ Detail Transaksi
    Route::get('/kasir/detail-transaksi', [DetailTransaksiController::class, 'index'])->name('kasir.detail-transaksi');
    Route::get('/kasir/transaksi/{id}/detail', [TransaksiController::class, 'detail'])->name('kasir.transaksi.detail');

    // Route untuk menghapus barang dari keranjang
    Route::delete('/kasir/transaksi/hapusBarang/{id}', [TransaksiController::class, 'hapusBarang'])->name('kasir.transaksi.hapusBarang');

    // Route untuk menampilkan detail transaksi
    Route::get('/kasir/detail-transaksi/{id}', [TransaksiController::class, 'show'])->name('kasir.detail-transaksi.index');

    // ✅ Route untuk melihat riwayat transaksi
    Route::get('/kasir/transaksi/riwayat', [TransaksiController::class, 'riwayat'])->name('kasir.transaksi.riwayat');

   // Route::post('/kasir/transaksi/proses', [TransaksiController::class, 'proses'])->name('kasir.transaksi.proses');

});
