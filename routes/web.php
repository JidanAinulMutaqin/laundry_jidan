<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PenjemputanController;
use App\Http\Controllers\BarangInventarisController;
use App\Http\Controllers\PenggunaanBarangController;

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
    return view('index');
});

// Route::get('/dashboard', function () {
//     return view('index');
// })->middleware('auth');

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::group(['prefix' => 'a', 'middleware' => ['isAdmin','auth']],function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('a.dashboard');

    Route::resource('/outlet', OutletController::class);
    Route::get('export/outlet', [OutletController::class, 'exportOutlet'])->name('export-outlet');
    Route::post('outlet/import', [OutletController::class, 'import'])->name('import-outlet');

    Route::resource('/paket', PaketController::class);
    Route::get('export/paket', [PaketController::class, 'exportData'])->name('export-paket');
    Route::post('paket/import', [PaketController::class, 'import'])->name('import-paket');

    Route::resource('/member', MemberController::class);
    Route::get('export/member', [MemberController::class, 'exportMember'])->name('export-member');
    Route::post('member/import', [MemberController::class, 'import'])->name('import-member');

    Route::resource('/user', UserController::class);

    Route::resource('/transaksi', TransaksiController::class);
    Route::get('{id}/faktur', [TransaksiController::class, 'fakturPDF'])->name('faktur');

    Route::resource('/laporan', LaporanController::class);
    Route::resource('/inventaris', BarangInventarisController::class);
    Route::get('/simulasi', [SimulasiController::class, 'index']);

    Route::resource('/penjemputan', PenjemputanController::class);
    Route::get('export/penjemputan', [PenjemputanController::class, 'exportPenjemputan'])->name('export-penjemputan');
    Route::post('penjemputan/import', [PenjemputanController::class, 'importPenjemputan'])->name('import-penjemputan');
    Route::post('/status', [PenjemputanController::class ,'status'])->name('status');

    Route::resource('/PenggunaanBarang', PenggunaanBarangController::class);
    Route::post('/status', [PenggunaanBarangController::class ,'status'])->name('status');
    Route::get('export/PenggunaanBarang', [PenggunaanBarangController::class, 'exportPenggunaanBarang'])->name('export-penggunaanBarang');
    Route::post('outlet/PenggunaanBarang', [PenggunaanBarangController::class, 'import'])->name('import-outlet');
});

Route::group(['prefix' => 'k', 'middleware' => ['isKasir','auth']],function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('k.dashboard');
    Route::resource('/paket', PaketController::class);
    Route::resource('/member', MemberController::class);
    Route::resource('/transaksi', TransaksiController::class);
});

Route::group(['prefix' => 'o', 'middleware' => ['isOwner','auth']],function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('o.dashboard');
});

