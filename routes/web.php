<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\barang;

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
    
    $user = Auth::id();
    
    
    $datas = barang::all();

    return view('welcome',compact('datas','user'));
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
       
    });
    Route::middleware('user')->group(function () {
        
    //     Route::get('/berhasil/{id}', [App\Http\Controllers\TransaksiController::class, 'berhasil'])->name('berhasil');
    //     Route::get('/keranjang/{id}', [App\Http\Controllers\TransaksiController::class, 'keranjang'])->name('keranjang');
    //     Route::post('/validation', [App\Http\Controllers\profileController::class, 'validasi'])->name('validation');
    //    
    //     Route::get('/pembayaran/{id}', [App\Http\Controllers\TransaksiController::class, 'pembayaran'])->name('pembayaran');
    //     Route::get('/bukti/{id}', [App\Http\Controllers\TransaksiController::class, 'bukti'])->name('bukti');
    //     Route::post('/bayar/{id}', [App\Http\Controllers\TransaksiController::class, 'bayar'])->name('bayar');
    //     Route::delete('/hapus/{id}', [App\Http\Controllers\TransaksiController::class, 'hapus'])->name('hapus');
           
    });
    Route::middleware('lelang')->group(function () {
        Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
        Route::resource('barang', BarangController::class);
        Route::get('/lelang/{id}', [App\Http\Controllers\LelangController::class, 'lelang'])->name('lelang');
        Route::post('/tambah/{id}', [App\Http\Controllers\LelangController::class, 'tambah'])->name('tambah');
        // Route::get('/dashboardsuperadmin', [dashboardController::class, 'index'])->name('dashboardsuperadmin');
        // Route::resource('dataadmin', adminController::class);
        // Route::get('/datauser', [App\Http\Controllers\userController::class, 'data'])->name('datauser');
        // Route::delete('/hapususer/{id}', [App\Http\Controllers\userController::class, 'delete'])->name('hapususer');
    });

});

require __DIR__.'/auth.php';
