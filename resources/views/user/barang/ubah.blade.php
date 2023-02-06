@extends('layouts.dashboard')
@section('antena')
<h1>Jenis barang</h1>
<nav>
  
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/barang">Jenis barang</a></li>
    <li class="breadcrumb-item active">Create</li>
  </ol>
@endsection
@section('isi')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Form tambah jenis barang</h5>      
      <form action="{{ route('barang.update',$datas->id) }}" method="POST" class="row g-3" enctype="multipart/form-data">
        @csrf
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Nama</label>
          <input type="text" name="name" value="{{ $datas->name }}" class="form-control" id="inputNanme4">
        </div>         
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Waktu</label>
          <input type="date" name="waktu" value="{{ $datas->waktu }}" class="form-control" id="inputNanme4">
        </div> 
        
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Harga awal</label>
          <input type="number" name="harga_awal" value="{{ $datas->harga_awal }}" class="form-control" id="inputNanme4">
        </div> 
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Deskripsi awal</label>
          <input type="text" name="deskripsi_awal" value="{{ $datas->deskripsi_awal }}" class="form-control" id="inputNanme4">
        </div> 
        <div class="col-12">
          <label for="inputNanme4" class="form-label">Image</label>
          <input class="form-control" type="file" id="image" name="image" value="{{ old('image') }}" />
              <img id="preview-image-before-upload" src="/assets/images/barang/{{ $datas->image }}" alt="" style="width: 250px" class="mt-3" />          
          </div> 
        
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form>

    </div>
  </div>
@endsection