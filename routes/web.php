<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\dashboardController;
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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware' => ['auth']], function () {
    Route::middleware('admin')->group(function () {
        Route::get('/dashboardAdmin', [dashboardController::class, 'index'])->name('dashboardsuperadmin');
        Route::resource('barang', adminController::class);
    });
    Route::middleware('user')->group(function () {
        Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    //     Route::get('/berhasil/{id}', [App\Http\Controllers\TransaksiController::class, 'berhasil'])->name('berhasil');
    //     Route::get('/keranjang/{id}', [App\Http\Controllers\TransaksiController::class, 'keranjang'])->name('keranjang');
    //     Route::post('/validation', [App\Http\Controllers\profileController::class, 'validasi'])->name('validation');
    //     Route::post('/tambah/{id}', [App\Http\Controllers\TransaksiController::class, 'tambah'])->name('tambah');
    //     Route::get('/pembayaran/{id}', [App\Http\Controllers\TransaksiController::class, 'pembayaran'])->name('pembayaran');
    //     Route::get('/bukti/{id}', [App\Http\Controllers\TransaksiController::class, 'bukti'])->name('bukti');
    //     Route::post('/bayar/{id}', [App\Http\Controllers\TransaksiController::class, 'bayar'])->name('bayar');
    //     Route::delete('/hapus/{id}', [App\Http\Controllers\TransaksiController::class, 'hapus'])->name('hapus');
    });
    Route::middleware('superadmin')->group(function () {
        // Route::get('/dashboardsuperadmin', [dashboardController::class, 'index'])->name('dashboardsuperadmin');
        // Route::resource('dataadmin', adminController::class);
        // Route::get('/datauser', [App\Http\Controllers\userController::class, 'data'])->name('datauser');
        // Route::delete('/hapususer/{id}', [App\Http\Controllers\userController::class, 'delete'])->name('hapususer');
    });

});

require __DIR__.'/auth.php';
