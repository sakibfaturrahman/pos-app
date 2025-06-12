<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PenjualanDetailController;

//login
Route::middleware('only_guest')->group(function () {
    Route::get('register', [LoginController::class, 'register'])->name('register');
    Route::post('register', [LoginController::class, 'register_action'])->name('register.action');
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'login_action'])->name('login.action');
    Route::get('password', [LoginController::class, 'password'])->name('password');
    Route::post('password', [LoginController::class, 'password_action'])->name('password.action');
});
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

//admin akses
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //penjualan
    Route::get('/detail_transaksi/baru', [PenjualanController::class, 'create'])->name('detail_transaksi.baru');
    Route::post('/detail_transaksi/save', [PenjualanController::class, 'store'])->name('detail_transaksi.save');
    Route::get('/detail_transaksi/selesai', [PenjualanController::class, 'selesai'])->name('detail_transaksi.selesai');
    Route::get('/detail_transaksi/struk-kecil', [PenjualanController::class, 'strukKecil'])->name('detail_transaksi.struk_kecil');
    Route::get('/detail_transaksi/struk-besar', [PenjualanController::class, 'strukBesar'])->name('detail_transaksi.struk_besar');

    Route::get('/detail_transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('detail_transaksi.data');
    Route::get('/detail_transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadForm'])->name('detail_transaksi.load_form');
    Route::resource('/detail_transaksi', PenjualanDetailController::class)
        ->except('create', 'show', 'edit');

    //profil
    Route::get('/profil', [UserController::class, 'profil'])->name('profil');

    //member
    Route::get('/member', [MemberController::class, 'index'])->name('member');
    Route::post('/member', [MemberController::class, 'store'])->name('member.tambah');
    Route::post('/member{id}', [MemberController::class, 'update'])->name('member.edit');
    Route::get('/member{id}', [MemberController::class, 'destroy'])->name('member.hapus');
    Route::post('/member/cetak-member', [MemberController::class, 'cetakMember'])->name('member.cetak_member');

    Route::middleware('auth', 'only_admin')->group(function () {
        //kategori
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.tambah');
        Route::post('/kategori{id}', [KategoriController::class, 'update'])->name('kategori.edit');
        Route::get('/kategori{id}', [KategoriController::class, 'destroy'])->name('kategori.hapus');

        //produk
        Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
        Route::post('/produk', [ProdukController::class, 'store'])->name('produk.tambah');
        Route::post('/produk{id}', [ProdukController::class, 'update'])->name('produk.edit');
        Route::get('/produk{id}', [ProdukController::class, 'destroy'])->name('produk.hapus');
        Route::post('/produk/delete-selected', [ProdukController::class, 'deleteSelected'])->name('produk.delete_selected');
        Route::post('/produk/cetak-barcode', [ProdukController::class, 'cetakBarcode'])->name('produk.cetak_barcode');

        //spplier
        Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
        Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.tambah');
        Route::post('/supplier{id}', [SupplierController::class, 'update'])->name('supplier.edit');
        Route::get('/supplier{id}', [SupplierController::class, 'destroy'])->name('supplier.hapus');

        //pengeluaran
        Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
        Route::post('/pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.tambah');
        Route::post('/pengeluaran{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.edit');
        Route::get('/pengeluaran{id}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.hapus');

        //pembelian
        Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
        Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian.index');
        Route::post('/pembelian', [PembelianController::class, 'store'])->name('pembelian.store');
        Route::get('/pembelian{id}', [PembelianController::class, 'destroy'])->name('pembelian.destroy');

        Route::get('/detail_pembelian/{id}/data', [PembelianDetailController::class, 'data'])->name('detail_pembelian.data');
        Route::get('/detail_pembelian/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('detail_pembelian.loadform');
        Route::resource('/detail_pembelian', PembelianDetailController::class)
            ->except('create', 'show', 'edit');

        //data penjualan
        Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.data');
        Route::get('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');

        //user
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::post('/users', [UserController::class, 'store'])->name('users.tambah');
        Route::post('/users{id}', [UserController::class, 'update'])->name('users.edit');
        Route::get('/users{id}', [UserController::class, 'destroy'])->name('users.hapus');

        //laporan
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
        Route::get('/laporan/pdf/{awal}/{akhir}', [LaporanController::class, 'exportPDF'])->name('laporan.export_pdf');

        //pengaturan toko
        Route::get('/setting', [SettingController::class, 'index']);
        Route::post('/setting/update', [SettingController::class, 'update'])->name('setting.update');
    });
});
