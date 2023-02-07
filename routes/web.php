<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\HistoryLelangController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\lelang;
use App\Models\history_lelang;
use Illuminate\Http\Request;   

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
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware' => ['auth']], function () {
    Route::middleware('admin')->group(function () {
        Route::get('/dashboardAdmin', [dashboardController::class, 'index'])->name('dashboardAdmin');       
        Route::get('/barangadmin', [App\Http\Controllers\BarangController::class, 'tampil'])->name('barangadmin');                    
        Route::resource('historyadmin', HistoryLelangController::class);
        Route::get('/laporanpdf', function () {    
               
            $datas = history_lelang::with(['silelang','barangs','iduser'])->get();
            $banyak = barang::join('history_lelangs', 'history_lelangs.id_barang', '=', 'barangs.id')->max('history_lelangs.penawaran_harga');
            
            $pdf = PDF::loadview('admin.pdf', compact('datas','banyak'));
            return $pdf->download('laporanpdf.pdf');
          
        });
    });
    Route::middleware('user')->group(function () {        
        Route::post('/tambahuser/{id}', [App\Http\Controllers\LelangController::class, 'tambah'])->name('tambahuser');
        Route::post('/ubahuser/{id}', [App\Http\Controllers\LelangController::class, 'ubah'])->name('ubahuser');
        Route::get('/lelanguser/{id}', [App\Http\Controllers\LelangController::class, 'lelang'])->name('lelanguser');            
        Route::post('/terimauser/{id}', [App\Http\Controllers\LelangController::class, 'terima'])->name('terimauser');
        Route::get('/historyuser/{id}', [App\Http\Controllers\HistoryLelangController::class, 'lelang'])->name('historyusers');
    });
    Route::middleware('lelang')->group(function () {
        Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
        Route::resource('barang', BarangController::class);
        Route::get('/lelang/{id}', [App\Http\Controllers\LelangController::class, 'lelang'])->name('lelang');
        Route::post('/tambah/{id}', [App\Http\Controllers\LelangController::class, 'tambah'])->name('tambah');
        Route::post('/ubah/{id}', [App\Http\Controllers\LelangController::class, 'ubah'])->name('ubah');
        Route::post('/terima/{id}', [App\Http\Controllers\LelangController::class, 'terima'])->name('terima');
        Route::get('/history/{id}', [App\Http\Controllers\HistoryLelangController::class, 'lelang'])->name('history');
        Route::post('/status/{id}', function (Request $request ,$id) {
            lelang::where('id_barang',$id)->update(['status' => $request->status]);
            barang::where('id',$id)->update(['status' => $request->status]);
            return  redirect()->back()->with('success','Berhasil di tutup');
        })->name('status');    
    });

});

require __DIR__.'/auth.php';
