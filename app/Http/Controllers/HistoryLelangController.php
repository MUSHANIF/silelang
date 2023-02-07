<?php

namespace App\Http\Controllers;

use App\Models\history_lelang;
use App\Models\barang;
use Auth;
use App\Http\Requests\Storehistory_lelangRequest;
use App\Http\Requests\Updatehistory_lelangRequest;

class HistoryLelangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lelang($id)
    {
        $datas = history_lelang::with(['silelang','barangs','iduser'])->where('userid', $id)->get();
        return view('user.history.index', compact('datas'));
    }
    public function index()
    {
        $datas = history_lelang::with(['silelang','barangs','iduser'])->get();
        $banyak = barang::join('history_lelangs', 'history_lelangs.id_barang', '=', 'barangs.id')->max('history_lelangs.penawaran_harga');
        return view('admin.history.index', compact('datas','banyak'));
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
     * @param  \App\Http\Requests\Storehistory_lelangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storehistory_lelangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\history_lelang  $history_lelang
     * @return \Illuminate\Http\Response
     */
    public function show(history_lelang $history_lelang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\history_lelang  $history_lelang
     * @return \Illuminate\Http\Response
     */
    public function edit(history_lelang $history_lelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatehistory_lelangRequest  $request
     * @param  \App\Models\history_lelang  $history_lelang
     * @return \Illuminate\Http\Response
     */
    public function update(Updatehistory_lelangRequest $request, history_lelang $history_lelang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\history_lelang  $history_lelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(history_lelang $history_lelang)
    {
        //
    }
}
