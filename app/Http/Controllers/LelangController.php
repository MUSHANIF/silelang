<?php

namespace App\Http\Controllers;

use App\Models\lelang;
use App\Models\barang;
use App\Models\history_lelang;
use Redirect;
use App\Http\Requests\StorelelangRequest;
use Auth;
use Illuminate\Http\Request;    
use App\Http\Requests\UpdatelelangRequest;

class LelangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah(Request $request , $id)
    {
        $data = lelang::where('userid',$id)->where('id_barang', $request->id )->where('status','dibuka')->first();
        $datas = barang::where('id', $request->id_barang)->first();
        $key = $datas->harga_awal;
        if($data){
            toastr()->error('barang ini sudah anda pesan!', 'gagal');
            return Redirect::back()->with('error','barang ini sudah anda pesan!');
        }elseif($key > $request->harga_akhir){            
            return Redirect::back()->with('error','uang anda kurang!');
        }else{
           
            $model = new lelang;
            $model->userid = $request->userid;
            $model->id_barang = $request->id_barang;
            $model->tgl_lelang = $request->waktu;
            $model->harga_akhir = $request->harga_akhir;
            $model->status = $request->status;                                    
            $model->save(); 
            
            return redirect()->route('lelang', Auth::id())->with('success','berhasil di tambahkan di daftar lelang anda');
        } 
    }
    public function lelang(Request $request , $id)  
    {
        $barang = barang::first();
        $barangs = $barang->id;
        $datas = lelang::with(['lelang'])->where('userid', $id)->get();
        $menang = lelang::with(['lelang'])->where('userid', $id)->where('status','ditutup')->where('id_barang' , $barangs)->max('harga_akhir');
        $ke = lelang::where('id_barang' , $barangs)->max('harga_akhir');
        
        return view('user.lelang.index', compact('datas','ke','menang'));
    }
    public function ubah(Request $request , $id)
    {
        $model = lelang::findOrFail($id);
                       
        $model->harga_akhir = $request->harga_akhir;                             
        $model->save();

        toastr()->success('Berhasil di u');
        if (Auth::user()->level == 2) {
            return redirect()->route('lelang', Auth::id())->with('success','berhasil di ubah di daftar lelang anda');
        }elseif(Auth::user()->level == 1){

            return redirect()->route('lelanguser', Auth::id())->with('success','berhasil di ubah di daftar lelang anda');
        }
        
    }
     public function terima(Request $request ,$id)
    {
        $model = new history_lelang ;
        
        $model->userid = $request->userid;
        $model->id_barang = $request->id_barang;
        $model->id_lelang = $request->id;
        $model->penawaran_harga = $request->penawaran_harga;
        $model->save();
        if(Auth::user()->level == 'lelang'){
            return redirect()->route('history', Auth::id())->with('success','Berhasil di terima');
        }else{
            return redirect()->route('historyuser', Auth::id())->with('success','Berhasil di terima');
        }
        
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorelelangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorelelangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function show(lelang $lelang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function edit(lelang $lelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelelangRequest  $request
     * @param  \App\Models\lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatelelangRequest $request, lelang $lelang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(lelang $lelang)
    {
        //
    }
}
