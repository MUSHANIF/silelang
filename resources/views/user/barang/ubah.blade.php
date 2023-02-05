@extends('layouts.dashboard')
@section('antena')
<h1>Jenis layanan</h1>
<nav>
  
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/jns">Jenis layanan</a></li>
    <li class="breadcrumb-item active">Ubah</li>
  </ol>
@endsection
@section('isi')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Form tambah jenis kursi</h5>      
    <form action="{{ route('kursi.update',$datas->id) }}" method="POST" class="row g-3" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" value="PATCH">
      <div class="col-12">
        <label for="inputNanme4" class="form-label">Nama layanan</label>
        <select class="form-select" name="layananid" aria-label="Default select example">
          @foreach ($data as $key )
                  <option value="{{ $key->id }}"  @selected($key->id == $datas->layananid)> {{ $key->name }}</option>
               @endforeach
        </select>
      
  
      </div>          
      <div class="col-12">
        <label for="inputNanme4" class="form-label">Stok kursi</label>
        <input type="text" name="nomor" value="{{ $datas->nomor }}" class="form-control" id="inputNanme4">
      </div> 
      <div class="col-12">
        <label for="inputNanme4" class="form-label">Status</label>
        <input type="text" name="status" value="{{ $datas->status }}" class="form-control" id="inputNanme4">
      </div>     
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
    </form>

  </div>
</div>
@endsection