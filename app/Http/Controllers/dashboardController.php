<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\barang;
use App\Models\lelang;
use Auth;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(Request $request) {
        return view('dashboard',[
                
            'pembeli' => lelang::where('userid','=', Auth::user()->id)->count(),
            'barang' => barang::where('userid','=', Auth::user()->id)->count(),
            'barangadmin' => barang::count(),
            'lelang' => lelang::count(),
            'user' => User::count(),
            // 'admin' => User::where('level', '=', 2)->count(),
            // 'transaksi' => transaksi::count(),
            // 'layanan' => layanan::where('status', '=', 1)->count(),
            
        
        ]);
    }
}
