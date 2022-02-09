<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;

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
    return view('login.index');
});

// Route::get('/dashboard', function () {
//     return view('index');
// })->middleware('auth');

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::group(['prefix' => 'a', 'middleware' => ['isAdmin','auth']],function(){
    Route::get('dashboard', [HomeController::class, 'index'])->name('a.dashboard');
    Route::resource('outlet', OutletController::class);
    Route::resource('paket', PaketController::class);
    Route::resource('member', MemberController::class);
    Route::resource('user', UserController::class);
});

Route::group(['prefix' => 'k', 'middleware' => ['isKasir','auth']],function(){
    Route::get('dashboard', [HomeController::class, 'index'])->name('k.dashboard');
    Route::resource('paket', PaketController::class);
    Route::resource('member', MemberController::class);
});

Route::group(['prefix' => 'o', 'middleware' => ['isAdmin','auth']],function(){
    Route::get('dashboard', [HomeController::class, 'index'])->name('o.dashboard');
});

