<?php

namespace App\Http\Controllers;

use App\Models\lelang;
use App\Models\barang;
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
        $data = lelang::where('userid',$id)->where('id_barang',$request->id )->where('status','dibuka')->first();
        if( $data){
            toastr()->error('barang ini sudah anda pesan!', 'gagal');
            return Redirect::back()->with('error','barang ini sudah anda pesan!');
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
        $datas = lelang::with(['lelang'])->where('userid', $id)->where('status', 'dibuka')->get();
        return view('user.lelang.index', compact('datas'));
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
