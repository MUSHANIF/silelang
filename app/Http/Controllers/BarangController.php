<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Auth;
use App\Models\lelang;
use App\Http\Requests\StorebarangRequest;
use App\Http\Requests\UpdatebarangRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tampil(Request $request)
    {
        $cari = $request->cari;
        $datas =  barang::with(['lelangs'])->get(); 
        $banyak = barang::join('lelangs', 'lelangs.id_barang', '=', 'barangs.id')->max('lelangs.harga_akhir');
        
        return view('admin.barang.index', compact('datas','banyak'));
    }
    public function index(Request $request)
    {
        $cari = $request->cari;
        $datas =  barang::where('userid', Auth::user()->id);
        
        
        return view('user.barang.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas =  DB::table('barangs')->get();
        return view('user.barang.create', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorebarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'waktu' => ['required'],
            'harga_awal' => ['required'],
            'image' => ['required'],
            'deskripsi_awal' => ['required', 'string'],                        
        ]);
        if ($image = $request->file('image')) {
            $destinationPath = 'assets/images/barang';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $validatedData['image'] = "$profileImage";
        }
        barang::create($validatedData);
        return redirect('/barang')->with('success', 'Barang created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        $barang = barang::first();
        $barangs = $barang->id;       
        $lelang = lelang::where('id_barang' , $barangs)->first();
        
        $id = $lelang->id_barang;
        $ke = lelang::where('id_barang' , $barangs)->max('harga_akhir');
   
        $datas  = barang::with(['lelangs'])->find($barang);
        
        return view('user.barang.detail',compact('datas','ke','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        
        $datas  = barang::find($id);
        return view('user.barang.ubah',compact('datas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebarangRequest  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatebarangRequest $request, barang $barang)
    {
        if ($image = $request->file('image')) {
            $destinationPath = 'assets/images/barang';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $model['image'] = "$profileImage";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(barang $barang)
    {
        //
    }
}
